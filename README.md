# AstraGal

#### AstraGal is an artwork portfolio website for my friend's application to University. It features a (mostly) SPA responsive front-end built in react, with Laravel as the backend framework.

The backend allows for the user to update the background image and the text content of the landing page and about section of the website. The user can also create posts here, create albums, assign posts to albums and so on. Multiple images can be added to one post as well.

---
Some 3rd party packages are used, such as [Intervention Image](http://image.intervention.io/) to create thumbnails for the posts, [HTML Purifier](http://htmlpurifier.org/) to make sure the body of the posts is safe before it's added to the database, [Slick for React](https://github.com/akiran/react-slick) for the slideshow on the individual post pages, and [React Spinners](https://www.davidhu.io/react-spinners/) for the loading spinners. React Router is used to route the frontend app, and Laravel router with blade views are used for the backend.


