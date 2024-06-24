<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Button Animation</title>
  <style>
    .timestamp__button {
      background: #f4511e;
      color: #fff;
      border: none;
      padding: 0.5rem 0.8rem;
      border-radius: 5px;
      font-weight: bold;
      letter-spacing: 0.1rem;
      word-spacing: 0.2rem;
      box-shadow: 0 1px 10px #f4511e;
      transition: all 0.1s ease-out;
      margin-right: 1rem;
    }

    .timestamp__button:hover {
      color: #f4511e;
      background: #fff;
    }

    .timestamp__button:active {
      transform: translateY(5px);
      box-shadow: 0 1px 0px #f4511e;
    }

    .signature-image {
      width: 120px;
      height: auto;
    }

    .signatureHide {
      display: none;
    }
  </style>
  <script>
    function toggleSignature(inputId, signatureId) {
      const inputField = document.getElementById(inputId);
      const signatureDiv = document.getElementById(signatureId);

      if (inputField.value.trim() === "") {
        signatureDiv.style.display = 'none';
      } else {
        signatureDiv.style.display = 'block';
      }
    }

    function toggleInputValue(buttonId, inputId, name) {
      const inputField = document.getElementById(inputId);

      if (inputField.value.trim() === "") {
        inputField.value = name;
      } else {
        inputField.value = "";
      }

      // Call toggleSignature to show/hide the signature div based on new input value
      toggleSignature(inputId, inputField.dataset.signatureId);
    }
    
    document.addEventListener("DOMContentLoaded", function() {
      const inputFields = document.querySelectorAll('.signature-input');
      inputFields.forEach(input => {
        input.addEventListener('input', function() {
          toggleSignature(this.id, this.dataset.signatureId);
        });
      });

      const buttons = document.querySelectorAll('.timestamp__button');
      buttons.forEach(button => {
        button.addEventListener('click', function() {
          toggleInputValue(button.id, button.dataset.inputId, button.dataset.name);
        });
      });
    });
  </script>
</head>
<body>
  <form>
    <button type="button" id="button1" class="timestamp__button" data-input-id="signatureInput1" data-name="John Doe">Signature Stamp 1</button>
    <input type="hidden" id="signatureInput1" class="signature-input" data-signature-id="signatureHide1" name="signature1" value="">
    <div id="signatureHide1" class="signatureHide"><img src="signature3.png" class="signature-image" draggable="false" oncontextmenu="return false;"></div>

    <button type="button" id="button2" class="timestamp__button" data-input-id="signatureInput2" data-name="Jane Smith">Signature Stamp 2</button>
    <input type="hidden" id="signatureInput2" class="signature-input" data-signature-id="signatureHide2" name="signature2" value="">
    <div id="signatureHide2" class="signatureHide"><img src="signature3.png" class="signature-image" draggable="false" oncontextmenu="return false;"></div>

    <button type="button" id="button3" class="timestamp__button" data-input-id="signatureInput3" data-name="Alice Johnson">Signature Stamp 3</button>
    <input type="hidden" id="signatureInput3" class="signature-input" data-signature-id="signatureHide3" name="signature3" value="">
    <div id="signatureHide3" class="signatureHide"><img src="signature3.png" class="signature-image" draggable="false" oncontextmenu="return false;"></div>

    <button type="submit">Submit</button>
  </form>
</body>
</html>
