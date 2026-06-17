define(function () {
  // Thai
  return {
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'à¹‚à¸›à¸£à¸”à¸¥à¸šà¸­à¸­à¸ ' + overChars + ' à¸•à¸±à¸§à¸­à¸±à¸à¸©à¸£';

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'à¹‚à¸›à¸£à¸”à¸à¸´à¸¡à¸à¹Œà¹€à¸à¸´à¹ˆà¸¡à¸­à¸µà¸ ' + remainingChars + ' à¸•à¸±à¸§à¸­à¸±à¸à¸©à¸£';

      return message;
    },
    loadingMore: function () {
      return 'à¸à¸³à¸¥à¸±à¸‡à¸„à¹‰à¸™à¸‚à¹‰à¸­à¸¡à¸¹à¸¥à¹€à¸à¸´à¹ˆà¸¡â€¦';
    },
    maximumSelected: function (args) {
      var message = 'à¸„à¸¸à¸“à¸ªà¸²à¸¡à¸²à¸£à¸–à¹€à¸¥à¸·à¸­à¸à¹„à¸”à¹‰à¹„à¸¡à¹ˆà¹€à¸à¸´à¸™ ' + args.maximum + ' à¸£à¸²à¸¢à¸à¸²à¸£';

      return message;
    },
    noResults: function () {
      return 'à¹„à¸¡à¹ˆà¸à¸šà¸‚à¹‰à¸­à¸¡à¸¹à¸¥';
    },
    searching: function () {
      return 'à¸à¸³à¸¥à¸±à¸‡à¸„à¹‰à¸™à¸‚à¹‰à¸­à¸¡à¸¹à¸¥â€¦';
    }
  };
});
