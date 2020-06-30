<?php 
namespace App\Views;
use App\Drinks\Model;
use App\Views\AddItem;
use Core\Views\Form;

class CatalogueData extends Catalogue
{
    public function __construct($card = [])
    {
        $data = $this->getCatalogueData();
        parent::__construct($data);
    }

    public function getCatalogueData()
    {
        $drinks = Model::getWhere([]);

        $card_array = [];

        foreach ($drinks as $drink) {

            $add_item = new AddItem();

            $add_item->getData()['fields']['id']['value'] = $drink->id;
            $add = new Form($add_item->getData());

            $card_array[] = [
                 'price' => $drink->price,
                 'photo' => $drink->photo,  
                 'name' => $drink->name,  
                 'amount' => $drink->amount,  
                 'percentage' => $drink->percentage,  
                 'size' => $drink->size,  
                 'button' => $add->render()
            ];
        }

        return $card_array;
    }

}