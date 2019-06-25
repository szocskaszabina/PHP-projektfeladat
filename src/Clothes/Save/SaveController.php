<?php

namespace Project\Clothes\Save;

use \Exception;
use Project\Clothes\Clothes;

class SaveController
{

    private $saver;
    public $sizes = ['xs', 's', 'm', 'l', 'xl'];

    public function __construct(Saver $saver)
    {
        $this->saver = $saver;
    }

    public function saveItem(array $item) {
       
        foreach ($item as $key => $value) {
            if($value === '' || $value === NULL) {
                throw new Exception('Minden mezőt szükséges kitölteni!');
            }
        }

        if (strlen($item['name']) > 200) {
            throw new Exception('Név túl hosszú!');
        };
        if ($item['discount'] >= 1 ||  $item['discount'] < 0) {
            throw new Exception('A kedvezmény értéke 1-nél kisebb, valamint 0 -val egyenlő, vagy annál nagyobb lehet!');
        };
        if (!in_array(strtolower($item['size']), $this->sizes, true)) {
            throw new Exception('Valid méretek: xs, s, m, l, xl');
            exit;
        };

        $toSave = (new Clothes)
            ->setName($item['name'])
            ->setPrice((int)$item['price'])
            ->setSize($item['size'])
            ->setColor($item['color'])
            ->setDiscount((float)$item['discount'])
            ->setDiscountedPrice()
            ;
        
        return $this->saver->save($toSave);
    }


}