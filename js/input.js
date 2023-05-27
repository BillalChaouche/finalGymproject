function limitInputLength(input, maxLength) {
    if (input.value.length > maxLength) {
      input.value = input.value.slice(0, maxLength); // Truncate the input value
    }
  }