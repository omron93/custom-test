# Web response tester

A simple framework that shows questions and tracks responses from the user.

The framework shows questions 'slide by slide'.
Two types of slides exist:

 - **introduction** - serves for an introduction of your questionnaire and to get necessary data from the user (e.g. Name, Age)
 - **questions** - contains your questions. The user gives his answers using the keyboard. His answer and a question response time are stored into a database. Times are stored in milliseconds.

## Adding your questionnaire

Your questionare is read from file `questionnaire.html`. This file is standard HTML file. See [HTML basics](https://www.w3schools.com/html/html_basic.asp).

Some lines with the following comment have special meaning:

 - `<!--++++-->`  - separate slides. Next slide is shown after pressing `Enter` key.

 - `<!--++++KEYS-->`  - separate slides and tells that next question will start response tracking. KEYS is a sequence of characters separated by ','. For example with 'a,s,d' framework will accept these three keys as a possible answer to record. Then a next slide is shown.

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

<!--++++-->

Do you like apple?
```




## Detailed information

Licence: MIT

Used JavaScript libraries:

- Owl carousel
- object-fit-images
