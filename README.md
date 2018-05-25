# Client Laravel pour utiliser l'API SOAP Yousign

## Description
Le package utilise le package [Yousign/yousign-api-client-php](https://github.com/Yousign/yousign-api-client-php).

Ce client permet d'utiliser l'[API Soap de Yousign](http://developer.yousign.fr) via le langage PHP.

## Éléments requis
- composer
- PHP >= 5.6
- Extension php-soap sur votre serveur

## Installation
```bash
composer require quentinbontemps/laravel-yousign
```

Pour les versions de Laravel inférieures à la 5.5 vous devez ajouter le ServiceProvider dans fichier ```config/app.php```

```php
'providers' => [
    .... 
    \QuentinBontemps\LaravelYousign\LaravelYousignServiceProvider::class,
],
```
À partir de la 5.5 le chargement du ServiceProvider se fera automatiquement.

## Configuration

Vous devez définir vos identifiants Yousign.

Vous avez deux solutions :
- via le fichier .env :
    - YOUSIGN_ENVIRONMENT=demo|prod (par défaut démo)
    - YOUSIGN_LOGIN=xxx
    - YOUSIGN_PASSWORD=xxx
    - YOUSIGN_ENCRYPTED_PASSWORD=true|false (par défaut false)
    - YOUSIGN_API_KEY=xxx
    
- via le fichier de configuration, en le publiant :
```bash
php artisan vendor:publish --tag=laravel_yousign_config
```

## Utilisation

```php
use use QuentinBontemps\LaravelYousign\Facades\LaravelYousign;

$client = LaravelYousign::client();
$result = $client->getCosignedFilesFromDemand(array(
    'idDemand' => 523020,
    'token' => '',
    'idFile' => 1128720
));

$dir = __DIR__.'/tmp';
if(!mkdir($dir) && !is_dir($dir, 0775)) {
    throw new \Exception('failed create tmp file');
}

file_put_contents($dir.'/result.pdf', $result->file);
```

## Contribution
Toutes les contributions sont les bienvenues
