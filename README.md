# Web response tester

A simple framework that shows questions and tracks responses from the user.

The framework shows questions 'slide by slide'.
Time spent on each slide is measured and stored into a database (times are stored in milliseconds).

Some slides can have key logging enabled. If a permitted key is pressed on these slides the user answer is stored into the database and a next slide is shown.


## Adding your questionnaire

Your questionare is read from file `questionnaire.html`. This file is standard HTML file. See [HTML basics](https://www.w3schools.com/html/html_basic.asp).

Some lines with the following comment have special meaning:

 - `<!--++++-->`  - separate slides.

 - `<!--++++OPTIONS-->`  - separate slides and add certain parameters to next slide.

`OPTIONS` has the format `KEYS:TIMEOUT`. Each part is optional and can be empty, colons at the end can be ommited.

- `KEYS` - list of characters separated by ','. It enables key logging for the next slide. When an allowed key is pressed, slide time and key value are stored and the next slide is shown. For example with 'a,s,d' framework will accept these three keys as a possible answer to record.
- `TIMEOUT` - if no answer is recorded in TIMEOUT milliseconds, the next page is shown. Progressbar for remaining time limit is shown on top of the page.

If key logging is disabled, you must use a clickable HTML elements with `buttonNext` class to get to the next page - for example `<button class="btn btn-outline-secondary btn-block buttonNext">Next</button>`.

## Getting results

Results can be viewed when accessing csv.php file - so result URL could be `https://<YOUR_URL>/csv.php`.

## Using web-response-tester

 1. Download this repository
 2. Edit `questionnaire.html`
 3. Edit `connect.php` to have correct credentials to your database
 4. Upload the content to your webhosting

## What is tracked

- time spent on every slide in the questionnaire - CSV fields 'sX_t'
- (for slides with enabled key logging) the key pressed on the slide - CSV fields 'sX_k'
- value of every [HTML input element]() with `name` attribute (this allows to get additional data from participants) - CSV fields correspond to attribute names

## Slide checks

Before showing the next slide, the framework checks that every input element with `name` attribute has some value. This ensures that you get answers to all required questions.

This is more complicated for checkboxes. For example, the checkbox which must be checked:

```javascript
<label style="display: flex;">
  <input type="checkbox" name="chk1" value="" onclick="this.value = (this.checked ? 1 : '');" style="margin-right: 30px;margin-top: 9px;display: block;">
  <div style="text-align: left;">I agree that I like this questionnaire</div>
</label>
```


## Example

```html
What is your sex?
<div class="form-group">
    <label class="radio-inline"><input type="radio" name="sex" value="1">Man</label>
    <label class="radio-inline"><input type="radio" name="sex" value="0">Woman</label>
</div>
<button type="button" class="btn btn-default btn-block buttonNext">Next</button>

<!--++++-->

<h3>How many fingers do you have?</h3>
<input type="number" name="fingers" min="0" max="20">

<div class="form-group">
    <label class="radio-inline"><input type="radio" name="rhanded" value="0">left</label>
    <label class="radio-inline"><input type="radio" name="rhanded" value="1">right</label>
</div>

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
      <li>to response <b>YES</b> press key <b>y</b></li>
      <li>to response <b>NO</b> press key <b>n</b></li>
    </ul>
</p>
There is time limit 2000ms for every question.
<button type="button" class="btn btn-default btn-block buttonNext">Next</button>

<!--++++y,n:2000-->

Do you like a banana?

<!--++++y,n:2000-->

Do you like apple?
```

## Examples of special features

To show the questionnaire in full-screen mode

(For security reasons web browsers allows full screen only when a user clicks on an element)

```javascript
<script>
function openFullscreen() {
  var elem = document.documentElement;
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
    elem.webkitRequestFullscreen();
  }
}
</script>
<button class="btn btn-outline-secondary btn-block buttonNext" onclick="openFullscreen();">Next</button>

```

To add additional constraints on the value of an input element (e.g. that value is less than 10)

```javascript
<script>
function check_value(){
  if(document.getElementById("myfield").value < 10) {
    // setting value to empty, to not allow going to next slide
    document.getElementById("myfield").value = "";
  }
}
</script>

<button class="btn btn-outline-secondary buttonNext" onclick="check_value();">Next</button>
```

To generate random user ID (every time the questionnaire is opened by user)

```javascript
<input id="userID" name="userID" style="pointer-events:none;font-size:35px;text-align:center" readonly>
<script>
document.getElementById("userID").value = Math.floor(Math.random() * 1000000);
</script>
```

To hide the progress bar

```javascript
<script>
// Hide a progress bar
$("#progressBar").hide();
</scrupt>
```

## Detailed information

Licence: MIT

Used JavaScript libraries:

- Owl carousel
- object-fit-images


PHP extensions:

- json
- mysqlnd
