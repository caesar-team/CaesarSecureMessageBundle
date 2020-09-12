# SecurityMessageBundle
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fcaesar-team%2FCaesarSecureMessageBundle.svg?type=shield)](https://app.fossa.com/projects/git%2Bgithub.com%2Fcaesar-team%2FCaesarSecureMessageBundle?ref=badge_shield)


## Installation
1. Install component via composer
```shell script
composer require caesar/security-message-bundle
```

2. Add component into `config/bundles.php` with following content:
```php
return [
//.............
Caesar\SecurityMessageBundle\SecurityMessageBundle::class => ['all' => true],
//.............
];
```

3. Add the configuration yaml into `config/routes/security_message.yaml` with following content:
```yaml
security_message_bundle:
  resource: '@SecurityMessageBundle/Controller/MessageController.php'
  prefix: /
  type: annotation
```

4. Implement `Caesar/SecurityMessageBundle/Service/ClientInterface.php`

5. Add the configuration yaml into `config/packages/security_message.yaml` with following content:
```yaml
security_message:
  client: <Class that implemented ClientInterface>
```
## Usage
####Create new message:
POST /message with
```json
{
  "message": "string",
  "secondsLimit": 20,
  "requestsLimit": 20
}
```
####Get message
GET /message/{id} 


## License
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fcaesar-team%2FCaesarSecureMessageBundle.svg?type=large)](https://app.fossa.com/projects/git%2Bgithub.com%2Fcaesar-team%2FCaesarSecureMessageBundle?ref=badge_large)