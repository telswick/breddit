// My subbreddits have title not name
    var SubbredditsListView = Backbone.View.extend({
        el: '<ul></ul>',

        template: _.template('\
            <% subbreddits.each(function(subbreddit) { %>\
                <li><a data-id="<%= subbreddit.id %>" href="#"><%= subbreddit.get("title") %></a></li>\
            <% }) %>\
        '),

        events: {
            'click a': function(event) {
                event.preventDefault();
                var subbredditId = $(event.target).data('id');
                var subbreddit = new SubbredditModel({id: subbredditId});
                subbreddit.fetch({
                    success: function() {
                        var postsListView = new PostsListView({ 
                            collection: subbreddit.get('posts')
                        });
                        $('#posts').html(postsListView.render().el);
                    }
                });
            }
        },

        initialize: function() {
            this.listenTo(this.collection, 'update', this.render);
        },

        render: function() {
            this.$el.html(this.template({ subbreddits: this.collection }));
            return this;
        }
    });

module.exports = SubbredditsListView;    