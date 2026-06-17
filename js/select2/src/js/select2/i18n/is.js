define(function () {
  // Icelandic
  return {
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'Vinsamlegast styttiÃ° texta um ' + overChars + ' staf';

      if (overChars <= 1) {
        return message;
      }

      return message + 'i';
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'Vinsamlegast skrifiÃ° ' + remainingChars + ' staf';

      if (remainingChars > 1) {
        message += 'i';
      }

      message += ' Ã­ viÃ°bÃ³t';

      return message;
    },
    loadingMore: function () {
      return 'SÃ¦ki fleiri niÃ°urstÃ¶Ã°urâ€¦';
    },
    maximumSelected: function (args) {
      return 'ÃÃº getur aÃ°eins valiÃ° ' + args.maximum + ' atriÃ°i';
    },
    noResults: function () {
      return 'Ekkert fannst';
    },
    searching: function () {
      return 'Leitaâ€¦';
    }
  };
});
