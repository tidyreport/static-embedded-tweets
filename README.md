

## static-embedded-tweets

Create fast loading static embedded tweets for your website.


## Install Details

CSS and JavaScript files are required to enable full styling and functionality of the embedded tweets created by the [static embedded tweets API](https://rapidapi.com/tidyreport/api/static-embedded-tweets/) available at [rapidapi.com](https://rapidapi.com/).



1. Include the external JavaScript file for twitter emoji’s into your webpage.  Instructions are available [here](https://github.com/twitter/twemoji).  Take a look at our index.html file for an example.
2. Add our static-tweet-gen.js file to your website and include it in your webpage.  Take a look at our index.html file for an example.
3. Add our static-tweet-gen.css file to your website and include it in your webpage.  Take a look at our index.html file for an example.


## API Usage

The [static embedded tweets API](https://rapidapi.com/tidyreport/api/static-embedded-tweets/) get-tweet endpoint available at [rapidapi.com](https://rapidapi.com/) returns a JSON encoded object.  You will need to decode the returned JSON object (use the json_decode function for php).  The decoded data will include 3 name-value pairs.  They are defined like this:



* success:  set to 0 for error, set to 1 for success
* message:  a string that describes the error on error, blank string on success.
* html:  the resulting html snippet on success, blank string on error.

The html snippet can be inserted into the body of your html page for a fast loading static embedded tweet.  Take a look at our index.html file for an example.  In this file we used the API to create the html snippet seen in the body for tweet id 440322224407314432.


## Requirements

You must subscribe to a plan to gain access to the [static embedded tweets API](https://rapidapi.com/tidyreport/api/static-embedded-tweets/) at rapidapi.com.  You must also sign up for a free twitter developer account [here](https://developer.twitter.com/en/apply-for-access) and then acquire your own free Twitter API Bearer Token which is a required input to the static embedded tweets API.


## Dark and Light Theme Support

The static-tweet-gen.css default theme is tweet-theme-light.  But, you can change the theme to either tweet-theme-light or tweet-theme-dark.  This is done by adding either the tweet-theme-light or the tweet-theme-dark class to a parent element of your choice in your html.


## Dynamic update

If you make dynamic changes to your page via ajax without reloading the page, you can add this line of JavaScript code when appropriate:  etweet.update().  This will update your static embedded tweets time, render the twitter emojis, and add click events to some of the elements.  All of this normally only happens on page load.
