<?php

namespace AppBundle\Fixtures;

use AppBundle\Entity\Category;
use AppBundle\Entity\Feature;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductFeature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    private $categories = [
        ['name' => 'HTML'],
        ['name' => 'Javascript'],
        ['name' => 'PHP'],
        ['name' => 'Python'],
        ['name' => 'CSS'],
        ['name' => 'Java'],
        ['name' => 'Android'],
        ['name' => 'Angular'],
        ['name' => 'Mobile'],
        ['name' => 'Front-end']
    ];

    private $features = [
        ['name' => 'Páginas'],
        ['name' => 'Editora'],
        ['name' => 'Autor'],
        ['name' => 'Formato']
    ];

    private $products = [
        [
            'name' => 'JQuery',
            'description' => 'Esqueça os livros que mais parecem uma documentação da API! Aqui você encontra jQuery apresentado de maneira incremental, substituindo código JavaScript longo e complicado.',
            'image' => 'ecmascript6.jpg',
            'price' => 29.99,
            'features' => [
                'autor' => 'Plínio Balduino',
                'formato' => 'E-book',
                'páginas' => 180,
                'editora' => 'Casa do Código'
            ],
            'categories' => [
                'front-end',
                'javascript'
            ]
        ],
        [
            'name' => 'Design Patterns com PHP 7',
            'description' => 'Do inglês Design Patterns, os Padrões de Projeto podem ser definidos como modelos de soluções para algum problema específico encontrado frequentemente dentro de um projeto de software. Com eles, conseguimos desenvolver sistemas mais modulares, expansíveis, reutilizáveis e com mais flexibilidade. Atualmente, dominá-los é considerada uma skill fundamental para qualquer desenvolvedor.',
            'image' => 'ecmascript6.jpg',
            'price' => 69.99,
            'features' => [
                'autor' => 'Gabriel Anhaia',
                'formato' => 'Impresso',
                'páginas' => 230,
                'editora' => 'Casa do Código'
            ],
            'categories' => [
                'php'
            ]
        ],
        [
            'name' => 'Test-Driven Development',
            'description' => 'Do inglês Design Patterns, os Padrões de Projeto podem ser definidos como modelos de soluções para algum problema específico encontrado frequentemente dentro de um projeto de software. Com eles, conseguimos desenvolver sistemas mais modulares, expansíveis, reutilizáveis e com mais flexibilidade. Atualmente, dominá-los é considerada uma skill fundamental para qualquer desenvolvedor.',
            'image' => 'ecmascript6.jpg',
            'price' => 45.99,
            'features' => [
                'autor' => 'Andre Cardoso, Mauricio Aniche',
                'formato' => 'E-book',
                'páginas' => 150,
                'editora' => 'Casa do Código'
            ],
            'categories' => [
                'php'
            ]
        ],
        [
            'name' => 'Ionic Framework',
            'description' => 'Com a crescente difusão dos SmartPhones, surgiu uma grande quantidade de Sistemas Operacionais, o que por consequência aumentava a dificuldade em padronizar uma linha de desenvolvimento de aplicações que fossem portáveis ou multiplataforma. Por conta disto, surgiram os frameworks para compilação híbrida de aplicativos sendo desenvolvidos em uma única linguagem. Hoje, sabe-se que isso é possível com a mesclagem de HTML, JavaScript e CSS, basicamente. Dentro deste contexto, uma ferramenta se destaca, não apenas por compilar de forma híbrida, mas por oferecer diversos componentes, suporte a debugs e fácil aprendizado através de linguagens já conhecidas. Este é o poderoso Ionic Framework. Nele é possível utilizar componentes responsivos e atrativos para o desenvolvimento dos aplicativos, com a possibilidade de compilação e fácil instalação nas diferentes plataformas mobile. Seu foco é o front view dos aplicativos, isto é, fornece componentes para o desenvolvimento da interface dos aplicativos, fazendo o controle através do AngularJS e sendo compilado pelo PhoneGap.',
            'image' => 'ecmascript6.jpg',
            'price' => 29.90,
            'features' => [
                'autor' => 'Adrian Gois',
                'formato' => 'E-book',
                'páginas' => 100,
                'editora' => 'Casa do Código'
            ],
            'categories' => [
                'angular',
                'mobile',
                'javascript',
                'html',
                'css'
            ]
        ],
        [
            'name' => 'Google Android',
            'description' => 'Faça as melhores aplicações Android com as melhores práticas da área. Aprenda como publicar a aplicação e tê-la no ar em 1 dia, saiba como utilizar o máximo dos aparelhos e crie aplicações extremamente ricas para celulares e tablets!',
            'image' => 'ecmascript6.jpg',
            'price' => 40.50,
            'features' => [
                'autor' => 'João Bosco Monteiro',
                'formato' => 'E-book',
                'páginas' => 318,
                'editora' => 'Casa do Código'
            ],
            'categories' => [
                'java',
                'mobile'
            ]
        ],
        [
            'name' => 'HTML5 e CSS3',
            'description' => 'Crie páginas elegantes de forma simples! HTML e CSS, quando bem utilizados, podem ser o sucesso de um projeto e, com os novos recursos, muito do que antes era trabalhoso agora não é mais.',
            'image' => 'ecmascript6.jpg',
            'price' => 50.00,
            'features' => [
                'autor' => 'Lucas Mazza',
                'formato' => 'Impresso',
                'páginas' => 438,
                'editora' => 'Casa do Código'
            ],
            'categories' => [
                'html',
                'css'
            ]
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $categories = $this->handleCategories($this->categories);
        $features = $this->handleFeatures($this->features);

        foreach($this->products as $data) {
            $productCategories = $this->getCategories($categories, $data['categories']);
            $productFeatures = $this->getFeatures($features, $data['features']);

            $product = new Product();
            $product->setName($data['name']);
            $product->setDescription($data['description']);
            $product->setImage($data['image']);
            $product->setPrice($data['price']);
            $product->setCategories($productCategories);
            $product->setFeatures($productFeatures);

            $manager->persist($product);
        }

        $manager->flush();
    }

    private function handleCategories(array $categories)
    {
        return array_map(function ($data) {
            $category = new Category();
            $category->setName($data['name']);

            return $category;
        }, $categories);
    }

    private function handleFeatures(array $features)
    {
        return array_map(function ($data) {
            $feature = new Feature();
            $feature->setName($data['name']);

            return $feature;
        }, $features);
    }

    private function getCategories(array $categories, array $productCategories)
    {
        return array_filter($categories, function(Category $category) use ($productCategories) {
            $name = strtolower($category->getName());

            return in_array($name, $productCategories);
        });
    }

    private function getFeatures(array $features, array $productFeatures)
    {
        $collection = new ArrayCollection();

        /* @var Feature $feature */
        foreach ($features as $feature) {

            $key = mb_strtolower($feature->getName(), 'utf-8');

            if (!array_key_exists($key, $productFeatures)) {
                continue;
            }

            $productFeature = new ProductFeature();
            $productFeature->setFeatureValue($productFeatures[$key]);
            $productFeature->setFeature($feature);

            $collection->add($productFeature);
        }

        return $collection;
    }
}