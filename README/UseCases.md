# UC1 Create new post
## Preconditions
A user is authenticated.
## Main scenario
1. Starts when a user wants to add a post.
2. System asks for a title and a body for the post.
3. User provides a title and a body for the post.
4. System checks for SQL injections before adding to database, and presents that the creation has succeded.

## Alternate scenarios
* 2a. User could not create new post
  1. System presents an error message.
  2. Step 2 in the main scenario.
  
***

# UC2 Showing all available posts to user
## Preconditions
A user is authenticated.
## Main scenario
1. Starts when a user wants to view all his/her posts.
2. System shows all available posts.


***

# UC3 Deleting a post
## Preconditions
A user is authenticated.
## Main scenario
1. Starts when a user wants to delete a post.
2. System shows all existion posts.
3. User clicks on the "Delete Post" button belonging to post that he/she wants removed.
4. The system deletes the post and presents that the deletion has succeded.

***


