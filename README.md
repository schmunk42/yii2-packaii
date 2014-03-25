Packaii
=======

Packagist composer package browser for Yii2 Framework


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist schmunk42/yii2-packaii "*"
```

or add

```
"schmunk42/yii2-packaii": "*"
```

to the require section of your `composer.json` file.


Setup
-----

Once the extension is installed, load the module in your application config:

```php
'modules'        => [
    'packaii' => [
        'class' => 'schmunk42\packaii\Module'
    ]
]
```

Setup a project root alias:

```php
'aliases'        => [
    '@root'   => realpath(__DIR__ . '/../../'), // path to your composer.json file

```

For easy access, we also recommend you to add the packaii panel to the debug toolbar:

```php
'panels'     => [
    'packaii'   => ['class' => 'schmunk42\packaii\panels\PackaiiPanel',],
]
```

Since you may hit the GitHub API limit of 50 requests per hour for unauthorized clients pretty fast.
You can add your GitHub username and password to the config:

```php
    'modules' => [
        'packaii' => [
            'gitHubUsername' => 'your_username',
            'gitHubPassword' => 'super_secrect'
        ],
    ],
```


Usage
-----

Follow the panel link to http://application/web/index.php?r=packaii.
On the index page you'll see some basic information about the packages installed.

You can search packages locally or on Packagist with the search box on the left sidebar.
After selecting a package, the README file and some action buttons for installing, updating or removing a package
will be displayed.

Please note that packaii is currently not executing any `composer` actions directly, but it will give you the commands
ready to copy and paste into your console.


Troubleshooting
---------------

Open http://your-application/index.php?r=debug/default/view&panel=packaii to check the module status.


Screenshots
-----------

![Packaii](https://pbs.twimg.com/media/Bh1tJ1wCAAE7du3.jpg:large)
