# Tutablog is an application where some users (Admin users) can create, edit, update and publish articles to make them available in the public to read and
maybe comment on. Users and the public can browse through a catalog of these articles and click to anyone to read more about the article and comment on them. This articles
are instantly published to the connected facebook pages and notifications are sent to the subscribers as soon as a post is published.

Features:
A user registration system that manages two types of users: Admin and authors
The blog will have an admin area and a public area separate from each other
The admin area will be accessible only to logged in admin users and the public area to the general public
In the admin section, two types of admins exist: 

Admin:
1. Can create, view, update, publish and delete ANY post.
2. Can also create and delete categories.
3. An Admin user (and only an Admin user) can create another admin user or Author
Can view, update and delete other admin users
4. Admin user (and only Admin) can deactivate and author
5. Gets notified when a post is submitted by an author
6. Gets notified when a post is published, deleted, updated and published by another admin user

Author:
1. Can create, view, update and delete only posts created by themselves
2. They cannot publish a post. All publishing of posts is done by the Admin user.
3. Only published posts are displayed in the public area for viewing
4. Each post is created under a particular category.
5. A many-to-many relationship exists between posts and categories.
6. Can edit their profiles
7. Can get notified when their post is published

The public place:
The public page lists posts; each post displayed with a featured image, title, and date of creation.
The user can browse through all posts listings under a particular category by clicking on the category
When a user clicks on a post, they can view the full post and comment at the bottom of the posts.
A share button exists which allows users to share posts to their facebook timeline
A Live search is implemented which allows the user to search posts titles and have the titles return on keyup
