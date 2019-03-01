# Management_users_groups with Symfony 4

 API which allow users and groups management 
 Out of scope: authentication, and roles management; forms and views
 
 User Stories:
- Authentication (Login and registre page)
- Create a user who is included in a group
- Check if this user exits and is active
- Modify the list of users of a group

Entities:
- Exploiter : Username, email , password
- User: email, last name, first name, state (active/ non active), creation date
- Group: name

API methods:
- /register/ - registration
- /login/ -   connexion
- /users/ - fetch(retrieve) list of users
- /users/ - create a user
- /users/id/ - fetch info of a user
- /users/id/ - modify users info
- /users/ -  delete users using modal
- /groups/ - fetch list of groups
- /groups/ - create a group
- /groups/id/ - modify group info

Relationship : Many To One between Users and Groups  
- Many users have one group
- One group has many users

Others:
- Message level animation (after error, after operation CRUD , Modal) 
- Validation constraints/rules
- Bootstrap 4



