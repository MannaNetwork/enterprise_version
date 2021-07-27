
 <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style type="text/css">
body {
  margin: 40px;
}

.sidebar {
        grid-area: sidebar;
    }

    .sidebar2 {
        grid-area: sidebar2;
    }

    .content {
        grid-area: content;
    }

    .header {
        grid-area: header;
    }

    .footer {
        grid-area: footer;
    }

    .wrapper {
        background-color: #fff;
        color: #444;
    }

  .wrapper {
    display: grid;
    grid-gap: 1em;
    grid-template-areas:
     "header"
     "sidebar"
     "content"
     "sidebar2"
     "footer"
  }

    @media only screen and (min-width: 500px)  {
    .wrapper {

        grid-template-columns: 20% auto;
        grid-template-areas:
    "header   header"
        "sidebar  content"
        "sidebar2 sidebar2"
        "footer   footer";
    }
    }

    @media only screen and (min-width: 900px)   {
        .wrapper {
      grid-gap: 20px;
            grid-template-columns: 280px 620px ;
            grid-template-areas:
      "header  header  header"
            "sidebar content "
            "footer  footer";
            max-width: 900px;
        }
    }

.box {
  background-color: #444;
  color: #fff;
  border-radius: 5px;
  padding: 10px;
  font-size: 150%; 
}

.header,
.footer {
  background-color: #999;
color: #111111;
font-weight: bold;
}

.sidebar2 {
  background-color: #ccc;
  color: #444;
}


 
</style>

