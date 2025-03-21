<?php
require "src/service/products.php";

class Products
{
    public function createProducts($id, $name, $price, $image, $description, $quantity, $sku)
    {
        $basePath = realpath(__DIR__ . '/../lang/products/') . '/';

        $product = [
            "id" => $id,
            "sku" => $sku,
            "name" => $name,
            "price" => $price,
            "image" => $image,
            "quantity" => $quantity,
            "description" => $description
        ];

        $products = getProductJsonLang("es");

        $products[] = $product;

        $json_data = json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($basePath . 'es.json', $json_data);

        echo "Producto agregado correctamente.";
    }

    public function updateProduct($id, $name, $price, $image, $description, $quantity, $sku)
    {
        $basePath = realpath(__DIR__ . '/../lang/products/') . '/';
        $products = getProductJsonLang("es");

        foreach ($products as $key => $product) {
            if ($product['id'] === $id) {
                $products[$key] = [
                    "id" => $product['id'],
                    "sku" => $sku,
                    "name" => $name,
                    "price" => $price,
                    "image" => $image,
                    "quantity" => $quantity,
                    "description" => $description
                ];

                // Convertir a JSON con formato legible
                $json_data = json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

                // Guardar el JSON actualizado
                file_put_contents($basePath . 'es.json', $json_data);

                echo "Producto actualizado correctamente.";
                return;
            }
        }
    }

    public function removeProduct($id)
    {
        $basePath = realpath(__DIR__ . '/../lang/products/') . '/';
        $products = getProductJsonLang("es");

        $newProducts = array_values(array_filter($products, function ($product) use ($id) {
            return $product['id'] != $id;
        }));

        $json_data = json_encode($newProducts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($basePath . 'es.json', $json_data);

        echo "Producto eliminado correctamente.";
    }

    public function getProducts($lang)
    {
        $products = getProductJsonLang("es");

        return $products;
    }

    public function getProduct($id)
    {
        $products = getProductJsonLang("es");

        $result = array_filter($products, function ($product) use ($id) {
            return $product['id'] == $id;
        });

        return !empty($result) ? reset($result) : null;
    }
}
