var Backbone = require('backbone');
var _ = require('underscore');

// My subbreddits have title not name
    var PostsListView = Backbone.View.extend({
        el: '<ul></ul>',
        template: _.template('\
            <% posts.each(function(post) { %>\
                <li>\
                        <a href="#post/<%= post.id %>"><%= post.get("title") %></a>\
                        <% if (post.get("subbreddit")) { %>\
                            <small><%= post.get("subbreddit").get("title") %></small>\
                        <% } %>\
                </li>\
            <% }) %>\
        '),

        initialize: function() {
            this.listenTo(this.collection, 'update', this.render);
        },

        render: function() {
            this.$el.html(this.template({ posts: this.collection }));
            return this;
        }
    });

module.exports = PostsListView;    