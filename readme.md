# KnowItFirst

Be the first to know when shit hits the fan. This package will catch the exceptions thrown by your crappy Laravel site and send you an annoying message to your Slack. Happy debugging!

## Install packages from Github

Edit */composer.json* in your project root folder

```json
"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/64kbytes/knowitfirst"
        },
        {
            "type": "vcs",
            "url": "https://github.com/64kbytes/slack"
        }
    ]
```
Requiring KnowitFirst from Github we need to require also it's dependencies. Please refer to [Why can't Composer load repositories recursively?](https://getcomposer.org/doc/faqs/why-can%27t-composer-load-repositories-recursively.md)

Then edit */config/app.php*
```php
'providers' => [
	Baytree\KnowItFirst\KnowItFirstServiceProvider::class
]
```

## Install for developing
Here is how I do it:

Provided a fresh Laravel installation in */workbench/laravel*:
1. Clone this repo in */workbench/packages/baytree/\<package-name\>*
2. cd to */workbench/laravel/packages/baytree*
3. ``` $ ln -s ../../packages/<package-name> <package-name> ```
4. cd to */workbench/packages/\<package-name\>*

