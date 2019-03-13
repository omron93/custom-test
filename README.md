# Web response tester

A simple framework that shows questions and tracks responses from the user.

The framework shows questions 'slide by slide'.
Time spent on each slide is measured and stored into a database (times are stored in milliseconds).

Some slides can have key logging enabled. If permitted key is pressed on these slides the user answer is stored into the database and a next slide is shown.


## Adding your questionnaire

Your questionare is read from file `questionnaire.html`. This file is standard HTML file. See [HTML basics](https://www.w3schools.com/html/html_basic.asp).

Some lines with the following comment have special meaning:

 - `<!--++++-->`  - separate slides. Next slide is shown after pressing `Enter` key.

 - `<!--++++OPTIONS-->`  - separate slides and add certain parameters to next slide.

`OPTIONS` has format `KEYS:TIMEOUT`. Each part is optional and can be empty, colons at the end can be ommited.

- `KEYS` - list of characters separated by ','. Enables key logging for next slide. When allowed key is pressed, slide time and key value are stored and next slide is shown. For example with 'a,s,d' framework will accept these three keys as a possible answer to record.
- `TIMEOUT` - if no answer is recorded in TIMEOUT milliseconds, next page is shown.

To get to the next page clickable HTML elements with `buttonNext` class can be used - for example `<button type="button" class="btn btn-default btn-block buttonNext">Next</button>
`.

## Getting results

Results can be viewed when accessing answers.php file - so URL is going to be `https://<YOUR_URL>/answers.php`. To download CSV go to `https://<YOUR_URL>/csv.php`.

## Using web-response-tester

 1. Download this repository
 2. Edit `questionnaire.html`
 3. Edit `connect.php` to contain credentials to your database
 4. Upload the content to your webhosting

## Example

```html
What is your sex?
<div class="form-group">
    <label class="radio-inline"><input type="radio" name="sex" value="1">Man</label>
    <label class="radio-inline"><input type="radio" name="sex" value="0">Woman</label>
</div>
<button type="button" class="btn btn-default btn-block buttonNext">Next</button>

<!--++++-->

<p>
    <i>The sky is blue!</i>
</p>

How do you agree with this?
<div class="form-group">
    <label class="radio-inline"><input type="radio" name="sky_blue" value="0">Strongly disagree</label>
    <label class="radio-inline"><input type="radio" name="sky_blue" value="1">Disagree</label>
    <label class="radio-inline"><input type="radio" name="sky_blue" value="2">Agree</label>
    <label class="radio-inline"><input type="radio" name="sky_blue" value="4">Strongly agree</label>
</div>
<button type="button" class="btn btn-default btn-block buttonNext">Next</button>

<!--++++-->

<h1>Please answer following question as fast as possible</h1>
<p>
    How to answer:
    <ul>
      <li>to response <b>YES</b> press key <b>F</b></li>
      <li>to response <b>NO</b> press key <b>J</b></li>
    </ul>
</p>
<button type="button" class="btn btn-default btn-block buttonNext">Next</button>

<!--++++f,j-->

Do you like a banana?

<!--++++f,j-->

Do you like apple?
```




## Detailed information

Licence: MIT

Used JavaScript libraries:

- Owl carousel
- object-fit-images


PHP extensions:

- json
- mysqlnd
