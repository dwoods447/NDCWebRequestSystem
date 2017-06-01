// Tabs
        var content = document.getElementsByClassName("tab-pane");
        var tabButtons = document.getElementsByClassName("tab-button ");

        if (content[0].style.display === "none" || content[0].style.display === "") {

            content[0].style.display = "block";
        }


		

        function openTab(event, tab) {
            // Get all elements with class="tab-pane" and hide them
            for (var index = 0; index < content.length; index++) {
                content[index].style.display = "none";
            }
            // Get all elements with class="tab-button" and remove the class "active"
			
            for (var index = 0; index < tabButtons.length; index++) {
                tabButtons[index].className = tabButtons[index].className.replace("active-tab", " ");
            }
			
            document.getElementById(tab).style.display = "block";
            event.currentTarget.className += " active-tab";
			
		
        }
		