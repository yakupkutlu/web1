define(function () {
  // Polish
  var charsWords = ['znak', 'znaki', 'znakÃ³w'];
  var itemsWords = ['element', 'elementy', 'elementÃ³w'];

  var pluralWord = function pluralWord(numberOfChars, words) {
    if (numberOfChars === 1) {
        return words[0];
    } else if (numberOfChars > 1 && numberOfChars <= 4) {
      return words[1];
    } else if (numberOfChars >= 5) {
      return words[2];
    }
  };
  
  return {
    errorLoading: function () {
      return 'Nie moÅ¼na zaÅ‚adowaÄ‡ wynikÃ³w.';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      return 'UsuÅ„ ' + overChars + ' ' + pluralWord(overChars, charsWords);
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;
      
      return 'Podaj przynajmniej ' + remainingChars + ' ' +
        pluralWord(remainingChars, charsWords);
    },
    loadingMore: function () {
      return 'Trwa Å‚adowanieâ€¦';
    },
    maximumSelected: function (args) {
      return 'MoÅ¼esz zaznaczyÄ‡ tylko ' + args.maximum + ' ' +
        pluralWord(args.maximum, itemsWords);
    },
    noResults: function () {
      return 'Brak wynikÃ³w';
    },
    searching: function () {
      return 'Trwa wyszukiwanieâ€¦';
    }
  };
});
