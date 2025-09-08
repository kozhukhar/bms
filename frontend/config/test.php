<?php
return [
    'id' => 'app-frontend-tests',
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
        ],
    ],
];


/*
 *
php yii gii/crud  --modelClass=app\models\Material --controllerClass=app\controllers\MaterialController --searchModelClass=app\models\MaterialSearch --viewPath=@app/views/materials --interactive=0 --overwrite=1
php yii gii/crud  --modelClass=app\models\Supplier --controllerClass=app\controllers\SupplierController --searchModelClass=app\models\SupplierSearch --viewPath=@app/views/suppliers --interactive=0 --overwrite=1
php yii gii/crud  --modelClass=app\models\Uoms --controllerClass=app\controllers\UomsController      --searchModelClass=app\models\UomsSearch      --viewPath=@app/views/uoms      --interactive=0 --overwrite=1
 */