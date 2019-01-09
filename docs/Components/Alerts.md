# Alerts
Provide contextual feedback messages for typical user actions with the handful of available and flexible alert messages.

<a name="examples"></a>
#### [# Examples](#examples)
Alerts are available for any length of text, as well as an optional dismiss button.

<div role="alert" class="alert alert-primary">This is a primary alert -- check it out!</div>
<div role="alert" class="alert alert-secondary">This is a secondary alert -- check it out!</div>
<div role="alert" class="alert alert-accent">This is a accent alert -- check it out!</div>
<div role="alert" class="alert alert-success">This is a success alert -- check it out!</div>
<div role="alert" class="alert alert-danger">This is a danger alert -- check it out!</div>
<div role="alert" class="alert alert-warning">This is a warning alert -- check it out!</div>
<div role="alert" class="alert alert-info">This is a info alert -- check it out!</div>
<div role="alert" class="alert alert-light">This is a light alert -- check it out!</div>
<div role="alert" class="alert alert-dark">This is a dark alert -- check it out!</div>

> ##### Conveying meaning to assistive technologies
> Using color to add meaning only provides a visual indication, which will not be conveyed to users of assistive technologies – such as `screen readers`.

<hr>

<a name="link-color"></a>
#### [# Link Color](#link-color)
Use the `.alert-link` utility class to quickly provide matching colored links within any alert.

<div role="alert" class="alert alert-primary">This is a primary alert -- <a href="#" class="alert-link">Click me</a>!</div>
<div role="alert" class="alert alert-secondary">This is a secondary alert -- <a href="#" class="alert-link">Click me</a>!</div>
<div role="alert" class="alert alert-accent">This is a accent alert -- <a href="#" class="alert-link">Click me</a>!</div>
<div role="alert" class="alert alert-success">This is a success alert -- <a href="#" class="alert-link">Click me</a>!</div>
<div role="alert" class="alert alert-danger">This is a danger alert -- <a href="#" class="alert-link">Click me</a>!</div>
<div role="alert" class="alert alert-warning">This is a warning alert -- <a href="#" class="alert-link">Click me</a>!</div>
<div role="alert" class="alert alert-info">This is a info alert -- <a href="#" class="alert-link">Click me</a>!</div>
<div role="alert" class="alert alert-light">This is a light alert -- <a href="#" class="alert-link">Click me</a>!</div>
<div role="alert" class="alert alert-dark">This is a dark alert -- <a href="#" class="alert-link">Click me</a>!</div>

<hr>

<a name="additional-content"></a>
#### [# Additional Content](#additional-content)
Alerts can also contain additional HTML elements like headings, paragraphs and dividers.

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Well done!</h4>
  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
  <hr>
  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
</div>

```html
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Well done!</h4>
  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
  <hr>
  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
</div>
```

<hr>

<a name="dismissing"></a>
#### [# Dismissing](#dismissing)
Using the alert JavaScript plugin, it’s possible to dismiss any alert inline.

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span class="mdi mdi-close" aria-hidden="true"></span>
  </button>
</div>

```html
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span class="mdi mdi-close" aria-hidden="true"></span>
  </button>
</div>
```

