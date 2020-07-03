<?php

namespace App\Views\Forms\Carts;
use App\App;
use App\Cart\Items\Model;
use App\Views\Forms\DeleteForm;
use App\Views\Forms\Tables\Table;

class CartData extends Table
{
    public function __construct($table = [])
    {

        $data = [
            'attr' => [
                'class' => 'users-table'
            ],
            'headings' => [
                'ID',
                'Name',
                'Price &euro;',
                'Remove'
            ],
            'rows' => $this->getCartData(),
        ];

        parent::__construct($data);
    }

    protected function getCartData()
    {
        $items = Model::getWhere(['user_id' => App::$session->getUser()->id]);

        $row = [];

        foreach ($items as $item_id => $item) {
            
            $delete_button = new DeleteForm();
            $delete_button->getData()['fields']['id']['value'] = $item->id;
            
            $drink = $item->drink();

            $row[] = [
                'id' => $item_id,
                'name' => $drink->name,
                'price' => $drink->price,
                'button' => $delete_button->render(),
            ];
        }

        return $row;
    }
}
