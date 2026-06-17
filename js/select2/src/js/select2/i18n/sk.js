define(function () {
  // Slovak

  // use text for the numbers 2 through 4
  var smallNumbers = {
    2: function (masc) { return (masc ? 'dva' : 'dve'); },
    3: function () { return 'tri'; },
    4: function () { return 'Å¡tyri'; }
  };

  return {
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      if (overChars == 1) {
        return 'ProsÃ­m, zadajte o jeden znak menej';
      } else if (overChars >= 2 && overChars <= 4) {
        return 'ProsÃ­m, zadajte o ' + smallNumbers[overChars](true) +
          ' znaky menej';
      } else {
        return 'ProsÃ­m, zadajte o ' + overChars + ' znakov menej';
      }
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      if (remainingChars == 1) {
        return 'ProsÃ­m, zadajte eÅ¡te jeden znak';
      } else if (remainingChars <= 4) {
        return 'ProsÃ­m, zadajte eÅ¡te ÄalÅ¡ie ' +
          smallNumbers[remainingChars](true) + ' znaky';
      } else {
        return 'ProsÃ­m, zadajte eÅ¡te ÄalÅ¡Ã­ch ' + remainingChars + ' znakov';
      }
    },
    loadingMore: function () {
      return 'Loading more resultsâ€¦';
    },
    maximumSelected: function (args) {
      if (args.maximum == 1) {
        return 'MÃ´Å¾ete zvoliÅ¥ len jednu poloÅ¾ku';
      } else if (args.maximum >= 2 && args.maximum <= 4) {
        return 'MÃ´Å¾ete zvoliÅ¥ najviac ' + smallNumbers[args.maximum](false) +
          ' poloÅ¾ky';
      } else {
        return 'MÃ´Å¾ete zvoliÅ¥ najviac ' + args.maximum + ' poloÅ¾iek';
      }
    },
    noResults: function () {
      return 'NenaÅ¡li sa Å¾iadne poloÅ¾ky';
    },
    searching: function () {
      return 'VyhÄ¾adÃ¡vanieâ€¦';
    }
  };
});
