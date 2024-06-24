<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signature Image Click</title>
  <style>
    .timestamp__image {
      width: 120px;
      height: auto;
      cursor: pointer;
      margin-right: 1rem;
      transition: transform 0.1s ease-out, box-shadow 0.1s ease-out;
    }

    .timestamp__image:active {
      transform: translateY(5px);
    }

    .signatureHide {
      display: none;
    }
  </style>
  <script>
    function toggleSignature(inputId, signatureIds) {
      const inputField = document.getElementById(inputId);
      const idsArray = signatureIds.split(',');

      idsArray.forEach(signatureId => {
        const signatureDiv = document.getElementById(signatureId);
        if (inputField.value.trim() === "") {
          signatureDiv.style.display = 'none';
        } else {
          signatureDiv.style.display = 'block';
        }
      });
    }

    function toggleInputValue(imageId, inputId, name) {
      const inputField = document.getElementById(inputId);

      if (inputField.value.trim() !== "") {
        return;
      }

      inputField.value = name;
      toggleSignature(inputId, inputField.dataset.signatureId);
    }

    document.addEventListener("DOMContentLoaded", function() {
      const inputFields = document.querySelectorAll('.signature-input');
      inputFields.forEach(input => {
        // Check the initial value and set the display state
        toggleSignature(input.id, input.dataset.signatureId);

        input.addEventListener('input', function() {
          toggleSignature(this.id, this.dataset.signatureId);
        });
      });

      const images = document.querySelectorAll('.timestamp__image');
      images.forEach(image => {
        image.addEventListener('click', function() {
          toggleInputValue(image.id, image.dataset.inputId, image.dataset.name);
        });
      });
    });
  </script>
</head>
<body>
  <form>
    <img src="signature-icon1.png" id="image1" class="timestamp__image" data-input-id="signatureInput1" data-name="John Doe" alt="Signature Stamp 1">
    <input type="hidden" id="signatureInput1" class="signature-input" data-signature-id="signatureHide1" name="signature1" value="">
    <div id="signatureHide1" class="signatureHide">
      <img src="signature3.png" class="signature-image" style="width: 120px; height: auto; object-fit: contain;" draggable="false" oncontextmenu="return false;">
    </div>

    <img src="signature-icon1.png" id="image2" class="timestamp__image" data-input-id="signatureInput2" data-name="Jane Smith" alt="Signature Stamp 2">
    <input type="hidden" id="signatureInput2" class="signature-input" data-signature-id="signatureHide2,signatureHide2_copy" name="signature2" value="">
    <div id="signatureHide2" class="signatureHide">
      <img src="signature3.png" class="signature-image" style="width: 120px; height: auto; object-fit: contain;" draggable="false" oncontextmenu="return false;">
    </div>
    <div id="signatureHide2_copy" class="signatureHide">
      <img src="signature3.png" class="signature-image" style="width: 120px; height: auto; object-fit: contain;" draggable="false" oncontextmenu="return false;">
    </div>

    <img src="signature-icon1.png" id="image3" class="timestamp__image" data-input-id="signatureInput3" data-name="Alice Johnson" alt="Signature Stamp 3">
    <input type="hidden" id="signatureInput3" class="signature-input" data-signature-id="signatureHide3" name="signature3" value="">
    <div id="signatureHide3" class="signatureHide">
      <img src="signature3.png" class="signature-image" style="width: 120px; height: auto; object-fit: contain;" draggable="false" oncontextmenu="return false;">
    </div>

    <button type="submit">Submit</button>
  </form>
</body>
</html>
