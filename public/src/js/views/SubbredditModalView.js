var Backbone = require('backbone');
var _ = require('underscore');

var SubbredditModel = require('../models/SubbredditModel');

var SubbredditModalView = Backbone.View.extend({
	el: '<div></div>',

	template: _.template('\
		<h3>Add a Subbreddit</h3>\
		<form>\
			<input type="text" name="title">\
			<textarea name="description"></textarea>\
			<input type="submit" value="Submit" class="button">\
		</form>\
	  <a class="close-reveal-modal" aria-label="Close">&#215;</a>\
	'),

	events: {
		'submit form': function(event) {
			var that = this;
			event.preventDefault();
			var subbreddit = new SubbredditModel({
				title: $(event.target).find('[name="title"]').val(),
				description: $(event.target).find('[name="description"]').val()
			});
			subbreddit.save(null, {
				success: function() {
					that.collection.add(subbreddit);
					$('#modal').foundation('reveal', 'close');
				}
			});
		}
	},

	render: function() {
		this.$el.html(this.template());
		return this;
	}

});

module.exports = SubbredditModalView;