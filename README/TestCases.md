## Test Case 5.1: Create new post with no title should fail

### Input
* Test case 1.7 - Successful login with correct Username and Password.
* Click on "Create new post" link.
* Leave the Title field blank.
* Enter something in the Body field.
* Click "Create Post" button.

### Output:
* Message: "Title is missing. You will need to add one."




***

## Test Case 5.2: Create new post with no body should fail

### Input
* Test case 1.7 - Successful login with correct Username and Password.
* Click on "Create new post" link.
* Enter something in the Title field.
* Leave the Body field blank.
* Click "Create Post" button.

### Output:
* Message: "Body is missing. You will need to add one."

***

## Test Case 5.3: Successful creation of new post

### Input
* Test case 1.7 - Successful login with correct Username and Password.
* Click on "Create new post" link.
* Enter something in the Title field.
* Enter something in the Body field.
* Click "Create Post" button.

### Output:
* Message: "Post Created"

***

## Test Case 6.1: Show user created posts - no posts exist

### Input
* Test case 1.7 - Successful login with correct Username and Password.
* Click on "Show all your posts" link.

### Output:
* Header: "View your existing posts below:"
* No posts listed.

***

## Test Case 6.2: Show user created posts - Posts exist

### Input
* Test case 1.7 - Successful login with correct Username and Password.
* Test case 5.3 - Successful creation of new post.
* Click on "back to login" link.
* Click on "Show all your posts" link.

### Output:
* Header: "View your existing posts below:"
* Added posts shows upp in list.

***

## Test Case 7.1: Successful deletion of post

### Input
* Test case 1.7 - Successful login with correct Username and Password.
* Test case 5.3 - Successful creation of new post.
* Click on "back to login" link.
* Click on "Show all your posts" link.
* Click on "Delete post" button.

### Output:
* Test Case 6.1 or 6.2 depending on existing amount of posts.
* Deleted post is not present in the list.

***
