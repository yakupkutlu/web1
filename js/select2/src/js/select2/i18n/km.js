define(function () {
  // Khmer
  return {
    errorLoading: function () {
      return 'á˜á·á“á¢á¶á…á‘á¶á‰á™á€á‘á·á“áŸ’á“á“áŸá™';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'áŸá¼á˜á›á»á”á…áŸá‰  ' + overChars + ' á¢á€áŸ’áŸáš';

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'áŸá¼á˜á”á‰áŸ’á…á¼á›' + remainingChars + ' á¢á€áŸ’áŸáš ášáº á…áŸ’ášá¾á“á‡á¶á„á“áŸáŸ‡';

      return message;
    },
    loadingMore: function () {
      return 'á€áŸ†á–á»á„á‘á¶á‰á™á€á‘á·á“áŸ’á“á“áŸá™á”á“áŸ’ááŸ‚á˜...';
    },
    maximumSelected: function (args) {
      var message = 'á¢áŸ’á“á€á¢á¶á…á‡áŸ’ášá¾áŸášá¾áŸá”á¶á“ááŸ‚ ' + args.maximum + ' á‡á˜áŸ’ášá¾áŸá”áŸ‰á»ááŸ’ááŸ„áŸ‡';

      return message;
    },
    noResults: function () {
      return 'á˜á·á“á˜á¶á“á›á‘áŸ’á’á•á›';
    },
    searching: function () {
      return 'á€áŸ†á–á»á„áŸáŸ’áœáŸ‚á„ášá€...';
    }
  };
});
