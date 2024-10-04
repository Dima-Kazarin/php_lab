<?php
class Product {
    public $name;
    public $description;
    protected $price;

    public function __construct($name, $price, $description) {
        $this->name = $name;
        $this->setPrice($price);
        $this->description = $description;
    }

    public function setPrice($price) {
        if ($price >= 0) {
            $this->price = $price;
        } else {
            throw new Exception("Ціна не може бути від’ємною.");
        }
    }

    public function getPrice() {
        return $this->price;
    }

    public function getInfo() {
        return "Назва: {$this->name}\nЦiнa: {$this->price}\nOпиc: {$this->description}\n";
    }
}

class DiscountedProduct extends Product {
    public $discount;

    public function __construct($name, $price, $description, $discount) {
        parent::__construct($name, $price, $description);
        $this->discount = $discount;
    }

    public function getDiscountedPrice() {
        return $this->price - ($this->price * $this->discount / 100);
    }

    public function getInfo() {
        $discountedPrice = $this->getDiscountedPrice();
        return parent::getInfo() . "Знижка: {$this->discount}%\nHoвa ціна: {$discountedPrice}\n";
    }
}

class Category {
    public $categoryName;
    public $products = [];

    public function __construct($categoryName) {
        $this->categoryName = $categoryName;
    }

    public function addProduct($product) {
        $this->products[] = $product;
    }

    public function showProducts() {
        echo "Категорія: {$this->categoryName}\n <br>";
        foreach ($this->products as $product) {
            echo $product->getInfo() . "\n";
        }
    }
}


$product1 = new Product("Ноутбук", 15000, "Ноутбук.");
$product2 = new Product("Мишка", 500, "Мишка.");

$discountedProduct1 = new DiscountedProduct("Смартфон", 12000, "Смартфон.", 10);
$discountedProduct2 = new DiscountedProduct("Телевізор", 20000, "Телевізор.", 20);

echo $product1->getInfo() . "<br>";
echo $product2->getInfo() . "<br>";
echo $discountedProduct1->getInfo() . "<br>";
echo $discountedProduct2->getInfo() . "<br>";

$electronics = new Category("Електроніка");
$accessories = new Category("Аксесуари");

$electronics->addProduct($product1);
$electronics->addProduct($discountedProduct1);
$accessories->addProduct($product2);
$accessories->addProduct($discountedProduct2);

$electronics->showProducts() . "<br>";
$accessories->showProducts();

?>