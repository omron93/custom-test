# Web response tester

A simple framework that shows questions and tracks responses from the user.

The framework shows questions 'slide by slide'.
Two types of slides exist:

 - **introduction** - serves for an introduction of your questionnaire and to get necessary data from the user (e.g. Name, Age)
 - **questions** - contains your questions. The user gives his answers using the keyboard. His answer and a question response time are stored into a database.

## Adding your questionnaire

Your questionare is read from file `questionare.html`. This file is standard HTML file. See [HTML basics](https://www.w3schools.com/html/html_basic.asp).

Some lines with the following comment have special meaning:

 - `<!--++++-->`  - separate slides. Next slide is shown after pressing `Enter` key.

 - `<!--++++KEYS-->`  - separate slides and tells that next question will start response tracking. KEYS is a sequence of characters separated by ','. For example with 'a,s,d' framework will accept these three keys as a possible answer to record. Then a next slide is shown.



## Example

```html
What is your sex?
<div class="form-group">
    <label class="radio-inline"><input type="radio" name="sex" value="1">Man</label>
    <label class="radio-inline"><input type="radio" name="sex" value="0">Woman</label>
</div>
<a href="#" class="btn buttonNext">Next</a>

<!--++++-->

<h1>Please answer following question as fast as possible</h1>
<p>
    How to answer:
    <ul>
      <li>to response <b>YES</b> press key <b>F</b></li>
      <li>to response <b>NO</b> press key <b>J</b></li>
    </ul>
</p>
<a href="#" class="btn buttonNext">Start</a>

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
