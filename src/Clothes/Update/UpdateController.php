<?php
namespace Project\Clothes\Update;

use \Exception;
use Project\Clothes\Clothes;

class UpdateController
{

    private $updater;
    public $sizes = ['xs', 's', 'm', 'l', 'xl'];

    public function __construct(Updater $updater)
    {
        $this->updater = $updater;
    }

    public function updateItem(array $item) {
        foreach ($item as $key => $value) {
            if($value === '' || $value === NULL) {
                throw new Exception('Minden mezőt szükséges kitölteni!');
            }
        }

        if (strlen($item['name']) > 200) {
            throw new Exception('Name is too long!');
        };
        if ($item['discount'] >= 1 ||  $item['discount'] < 0) {
            throw new Exception('Discount most be at least 0 and less than 1');
        };
        if (!in_array(strtolower($item['size']), $this->sizes, true)) {
            throw new Exception('Valid sizes:');
            exit;
        };

        $clothes = (new Clothes)
            ->setId((string)$item['id'])
            ->setName($item['name'])
            ->setPrice((int)$item['price'])
            ->setSize($item['size'])
            ->setColor($item['color'])
            ->setDiscount((float)$item['discount'])
            ->setDiscountedPrice()
            ;
        
        return $this->updater->updateClothes($clothes);
    }


}