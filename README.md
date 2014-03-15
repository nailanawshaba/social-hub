#social-hub

Embed your posts from your social networks in your Website. (Currently we support only Facebook and Twitter)

To develop this project I used the following libraries:  
 - [Facebook PHP SDK](https://developers.facebook.com/docs/reference/php/)
 - [Twitter Client](https://bitbucket.org/mnbayazit/twitterclient)
 - [Masonry](http://masonry.desandro.com)


## Getting started

### Install Yeoman and the generator-php

[Yeoman](http://yeoman.io/) is the best tool to scaffold your projects. Is as simple as run:

```
$ npm install -g yo
```

Then, install the [generator-php](https://github.com/Bradleycorn/generator-php):

```
$ npm install -g generator-php
```

### Download social-hub and Configure your API Keys

Download the project and edit the keys.ini. In order to fetch your posts from your accounts, you have set your public/private API information located at app/lib/socialhub/keys.ini. This information is provided by your Facebook and Twitter profiles.


### Install dependencies

Before anything works, you need to install the following dependencies:

#### PHP CURL

```
$ apt-get install curl libcurl3 libcurl3-dev php5-curl
```

#### PHP JSON

```
$ apt-get install php5-json
```

### Final step
Once you have installed all the dependencies, launch the app: 

```
$ grunt server
```

A new browser will open, if it doesn't appear go to http://localhost:9090/