function autofocusNext(currentInput, nextInputId) {
    var maxLength = parseInt(currentInput.getAttribute('maxlength'));
    var currentLength = currentInput.value.length;
  
    if (currentLength === maxLength) {
      var nextInput = document.getElementById(nextInputId);
      nextInput.focus();
    }
  }