<?php

require('connection/connection.php');
require('functions/function.php');

LoginCheck();
LoadWorkstation();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="content/css/style.css">

    <title>TestMezure</title>

    <style>
        .container1 {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .h1ex {
            text-align: center;
        }

        .labelex {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .selectex,
        .inputex {
            width: 100%;
            padding: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .buttonex {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-bottom: 20px;
        }

        .buttonex:hover {
            background-color: #0056b3;
        }

        .member-listex {
            list-style: none;
            padding: 0;
        }

        .member-listex .liex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 0;
        }

        .remove-memberex {
            color: red;
            cursor: pointer;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!--navbar-->
    <?php
    require('NavBar.php')
    ?>

    <!--features-->
    <section id="features" class="" style="min-height:715px">
        <div class="container1">

            <form action="testmezure.php" method="POST">
                <?php
                if (!isset($_SESSION['CreateWSSt']) && !isset($_SESSION['HaveWS'])) {
                ?>
                    <div id="workspaceRegSection">
                        <h2>Workspace Registration</h2>
                        <h4>Only Have One Workspace for Users</h4>
                        <label class="labelex" for="userType">Select User Type:</label>
                        <select class="selectex" id="userType" name="userType">
                            <option value="freelancer">Freelancer</option>
                            <option value="student">Student</option>
                            <option value="organization">Organization</option>
                            <option value="other">Other</option>
                        </select>
                        <label class="labelex" for="workspaceName">Workspace Name:</label>
                        <input class="inputex" type="text" id="workspaceName" name="workspaceName" value="<?php echo $workspaceName  ?>" required>
                        <button class="buttonex" type="submit" name="createWorkspace">Create Workspace</button>
                    </div>

                <?php
                } else if (isset($_SESSION['CreateWSSt'])){
                ?>

                    <div style="margin-top: 20px;" id="addMemberSection">
                        <h3>Add Members to <?php echo $_SESSION['WorkspaceName'] != '' ? $_SESSION['WorkspaceName'] : 'Workspace' ?></h2>
                            <div style="float: right;">
                                <a href="folders.php"><u>goto workplace</u></a>
                            </div>
                            <label class="labelex" for="email">Email:</label>
                            <input class="inputex" type="email" id="email" name="ad-email">
                            <button class="buttonex" name="addMembers">Add Member</button>

                            <ul class="member-listex" id="membersList">
                                <table class="table">

                                    <thead>
                                        <tr>
                                            <td>Email</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $wid = $_SESSION['WorkspaceId'];
                                        if ($post = GetWorkspaceUsersById($wid)) {
                                            while ($row = mysqli_fetch_assoc($post)) {
                                                if ($row['isAdmin'] == '0') {
                                                    $wuidd = $row['id'];
                                        ?>
                                                    <tr>
                                                        <td><?php echo $row['email'] ?></td>
                                                        <td><?php echo "<a href='testmezure.php?mmr=$wuidd'>remove</a>"; ?></td>
                                                    </tr>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </ul>
                    </div>
                <?php
                }
                else if (isset($_SESSION['HaveWS'])) {
                    OpenURL('folders.php');
                }
                ?>
            </form>
        </div>

        <script>
            function EnableMember() {

                debugger;
                var divId = document.getElementById('addMemberSection');
                divId.style.display = 'block';

                debugger;

            }
            // JavaScript functions for adding members
            function addMember() {
                // Get user input
                var email = document.getElementById("email").value;
                var userType = document.getElementById("userType").value;

                // Create a new list item for the member
                var memberItem = document.createElement("li");
                memberItem.innerHTML = `
                ${email} (${userType})
                <span class="remove-memberex" onclick="removeMember(this)">Remove</span>
            `;

                // Add the member item to the list
                document.getElementById("membersList").appendChild(memberItem);

                // Clear input fields
                document.getElementById("email").value = "";
                document.getElementById("userType").value = "freelancer";
            }

            function removeMember(element) {
                // Remove the member item from the list
                var listItem = element.parentNode;
                listItem.parentNode.removeChild(listItem);
            }

            function registerWorkspace() {
                // Get user input
                var workspaceName = document.getElementById("workspaceName").value;

                // Collect member data from the list
                var members = [];
                var memberItems = document.querySelectorAll(".member-listex liex");
                memberItems.forEach(function(memberItem) {
                    var parts = memberItem.textContent.split(" ");
                    var email = parts[0];
                    var userType = parts[1].replace("(", "").replace(")", "");
                    members.push({
                        email: email,
                        userType: userType
                    });
                });

                // You can now handle the registration process or send this data to a server
                console.log("Workspace Name:", workspaceName);
                console.log("Members:", members);
            }
        </script>
    </section>





    <!--footer-->
    <footer class="py-4" style="margin-top: -35px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">Developed By Sandun Jeewantha </p>
                </div>

            </div>
    </footer>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="content/js/app.js"></script>
</body>

</html>