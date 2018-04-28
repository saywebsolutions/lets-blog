# Let's Blog

A simple command line, markdown based blog add-on package for Laravel including support for tags and series of related posts.

## Installing

Include the package via composer:

~~~
composer require "saywebsolutions/letsblog"
~~~

Add provider to `config/app`:

~~~
'providers' => [
	SayWebSolutions\LetsBlog\Providers\LetsBlogServiceProvider::class,
	...
]
~~~

Migrate the Let's Blog tables:

~~~
php artisan migrate --path=/vendor/saywebsolutions/letsblog/database/migrations
~~~

Navigate to `/blog` and see the default blog page.

## Adding & Updating Posts

Write posts using the markdown format, and by default posts should go in the `./blog/posts` directory.

After adding/editing a post run the `letsblog:build` command to add the new post(s) and/or apply your edits:

~~~
php artisan letsblog:build
~~~

The main key used for checking existing posts will be the `identifier` field which by default uses the filename.

## Post Format

The post format should look like the following:

~~~
---
title: LetsBlog Package Released
slug: letsblog-package-released-laravel
meta: LetsBlog package released for Laravel.
keywords: letsblog, package, laravel, release
published_at: 2018-03-17
tags: LetsBlog, Laravel
series: LetsBlog Package
---

## Post Title

Post contents...

~~~

You can set any fields in the top section of the file. Any that DO NOT have a parser will just get tossed into a default `meta` field. Otherwise if a parser is found it will run. The parsers can manipulate a `data` object which ultimately get's passed into the `create` method for the `posts` table.

Current parsers are:

* Title
* Meta (description)
* Body
* PublishedAt
* Permalink (`slug`)
* Tags
* Series

## Config

The best way to get a sense of the config options is to just publish the config and take a look:

~~~
php artisan vendor:publish --provider="SayWebSolutions\LetsBlog\Providers\LetsBlogServiceProvider" --tag=config
~~~

## Migrations

The migration can be run directly from the packages `migrations` folder:

~~~
php artisan migrate --path=/vendor/saywebsolutions/letsblog/database/migrations
php artisan migrate:rollback
~~~

If the migrations need to be published to the parent app, use the `vendor:publish` command:

~~~
php artisan vendor:publish --provider="SayWebSolutions\LetsBlog\Providers\LetsBlogServiceProvider" --tag=migrations
~~~

## Themes

To set a theme set the 'letsblog.theme' property in the config. To simplify things ALL views should simply use `letsblog::theme.master` as the main view. Then a `view` is set as part of the data sent to the view.

```
return view('letsblog::themes.master', [
    'view' => lb_view('post.show'),
]);
```

The `lb_view` is a shortcut helper to use to avoid having to set the full path with the theme each time. This allows easy swapping of themes by only having to change the config parameter.

So far the currently supported themes are:

* default
* extension

### Default Theme

The default theme is currently untested, and may or may not be working.

### Extension Theme

The extension theme is useful if you have an existing blade layout you'd like to embed the blog in. Right now the extension theme expects Bootstrap 3 to be available in the parent application.

Make sure to have a yield directive for javascript in your parent layout, ex.):

```
@yield ('javascript')
```

## Overriding Layouts

In many cases you will want to add some customization to the layout to include some analytics tracking or ads for instance. To allow this the themes include many section blocks that can replace or modify existing layout.

To start, create an `overrides` file in the views directory:

```
/resources/views/vendor/letsblog/themes/overrides.blade.php
```

From there the following section blocks can be used which hopefully are self explanatory.

* `meta.opensearch`
* `meta.title`
* `meta.keywords`
* `meta.description`
* `meta.og`
* `head.files`
* `head.styles`
* `sidebar.series`
* `sidebar.popular`
* `component.search`
* `component.related`
* `footer-nav.left`
* `footer-nav.right`
* `post.list`
* `post.head`
* `post.series`
* `post.body`
* `post.related`
* `page.head`
* `page.body`
* `layout.view`
* `layout.end`

## Customize

For customization the `LetsBlog` facade may be used.

~~~
'aliases' => [
  'Blog'      => SayWebSolutions\LetsBlog\Facades\LetsBlogFacade::class,
  ...
]
~~~

The facade provides access to the following shortcut functions:

* **`published()`** - Paginated list of posts.
* **`search($q)`** - Paginated list of posts by search.
* **`all()`** - All posts.
* **`last()`** - Last post (by published_at date).
* **`post($slug)`** - Post or page by slug.
* **`count()`** - Post count.
* **`top($amount)`** - Top posts (default 10).
* **`tags()`** - All tags.
* **`publishedWhereTag($tag)`** - Paginated list of posts by tag.

## Assets

Publish all files from the package:

~~~
php artisan vendor:publish --provider="SayWebSolutions\LetsBlog\Providers\LetsBlogServiceProvider"
~~~

Or publish separately:

~~~
php artisan vendor:publish --provider="SayWebSolutions\LetsBlog\Providers\LetsBlogServiceProvider" --tag=migrations
php artisan vendor:publish --provider="SayWebSolutions\LetsBlog\Providers\LetsBlogServiceProvider" --tag=views
php artisan vendor:publish --provider="SayWebSolutions\LetsBlog\Providers\LetsBlogServiceProvider" --tag=config
php artisan vendor:publish --provider="SayWebSolutions\LetsBlog\Providers\LetsBlogServiceProvider" --tag=assets
~~~

## Headers & Footers

Each theme should also support a header and footer section (and perhaps more standard sections to follow). The idea is that a list of views can be provided and they will be included in that order.

This allows the inclusion of any ads or analytics tracking codes.

## Adding Parser

To add a parser, create a class with the name of the key being parsed. So `title` would look for `SayWebSolutions\LetsBlog\Parser\Field\Title`. This way additional fields may be added or existing ones overridden.

## To Do

Some things that still need to be done.

* Admin section (with WYSIWYG MD editor)
* Additional themes
* Comments
