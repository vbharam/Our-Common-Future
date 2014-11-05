// UWCnext: is a platform that allows UWC studens and alumnies to live their UWC dream...
//returns to main/home page...
function homeReturn() {
  window.location.reload(true);
}


// Google Sign In
function signinCallback(authResult) {
  if (authResult['status']['signed_in']) {
    // Update the app to reflect a signed in user
    // Hide the sign-in button now that the user is authorized, for example:
    // document.getElementById('signinButton').setAttribute('style', 'display: none');
    console.log("Signed in");
    gapi.client.load('plus', 'v1', loadProfile);
  } else {
    // Update the app to reflect a signed out user
    // Possible error values:
    //   "user_signed_out" - User is signed-out
    //   "access_denied" - User denied access to your app
    //   "immediate_failed" - Could not automatically log in the user
    console.log('Sign-in state: ' + authResult['error']);
  }
}

function loadProfile() {
  var request = gapi.client.plus.people.get({
    'userId': 'me'
  });
  request.execute(loadProfileCallback);
}

function loadProfileCallback(obj) {
  console.log(obj['emails'][0].value);
}

function submitProjectDescription() {
  $("#projectDescriptionForm").hide();
  $("#projectCreatorForm").slideDown("slow");
}

function submitProjectCreator() {
  $("#projectCreatorForm").hide();
  $("#projectAdvisorForm").slideDown("slow");
}

function goToProjectDescription() {
  $("#projectCreatorForm").hide();
  $("#projectDescriptionForm").slideDown("slow");
}

function goToProjectCreator() {
  $("#fillAllRequiredFieldsAlert").hide();
  $("#projectAdvisorForm").hide();
  $("#projectCreatorForm").slideDown("slow");
}

function addTeamMembers() {
  $("#projectCreatorForm").show();
  $("#teamquestion").slideDown("slow");
  $("#submitAddExtraCreators").hide();
}

function addExtraCreators() {
  var e = document.getElementById("selectTeam");
  var totalMembers = e.options[e.selectedIndex].value;
  //alert (totalMembers);
  $("#teamquestion").hide();
  for (var i = 0; i < totalMembers; i++) {
    var temp = totalMembers - i + 1;

    var newSelectEmail = ("<tr style='margin-bottom:40px;'><td><label>Email<small id='emailWarning' class='text-muted' style='color: #B3B3B3; margin-left: 5px'></small> </label><input class='form-control' type='email' name='creator" + temp + "Email' id='creator" + temp + "Email' placeholder='(Required)' required></td></tr><br>");
    CreateTableRow("addExtraCreators", newSelectEmail);

    var newSelectRole = ("<tr style='margin-bottom:20px;'><td><label>Role<small id='roleWarning' class='text-muted' style='color: #B3B3B3; margin-left: 5px'></small> </label><input class='form-control' type='text' name='creator" + temp + "Role' id='creator" + temp + "Role' placeholder='(Required)' required></td></tr>");
    CreateTableRow("addExtraCreators", newSelectRole);

    var newSelectName = ("<tr style='margin-bottom:20px;'><td><label>Name<small id='nameWarning' class='text-muted' style='color: #B3B3B3; margin-left: 5px'></small> </label><input class='form-control' type='text' name='creator" + temp + "Name' id='creator" + temp + "Name' placeholder='(Required)' required></td></tr>");
    CreateTableRow("addExtraCreators", newSelectName);

  };
}




function addAssociationDescription(){
var e = document.getElementById("selectUWC");
var option = $.trim(e.options[e.selectedIndex].value);
 //alert(option);
  if ((option == "Short Programs") || (option == "UWC Associate") || (option == "UWC Faculty") || (option == "UWC staff") || (option == "Other")){
   //alert(option);
   $("#updateForm").show();
   $("#memberAssociation").slideDown("slow");
 }else{
  $("#memberAssociation").hide();
 }
}






function activaTab(tab){
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};

function showVideo(link) {
  console.log(link);
  if (link.match(/watch\?v=([a-zA-Z0-9\-_]+)/)) {
    var youtube_id = link.split("v=")[1].substring(0, 11);
    var content = $('#videoContent').html("<div style='text-align:center; padding:20px;'><iframe width='500' height='500' src='https://www.youtube.com/embed/" + youtube_id + "' frameborder='0' allowfullscreen></iframe></div>");
        

  } else {
    var vimeo_Reg = /https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/;
    var match = link.match(vimeo_Reg);
    if (match) {
      var content = $('#videoContent').html("<div style='text-align:center; padding:20px;'><iframe width='500' height='500' src='//player.vimeo.com/video/" + match[3] + "?portrait=0&amp;badge=0' frameborder='0' allowfullscreen></iframe></div>");
    } else {
      console.log('Can not detect the Vimeos ID');
    }
  }
}

function helpInitiative(pageNumber) {
  $("#feed").html("");
  $("#totalProjectPagination").html("");
  $.ajax({
    type: "POST",
    url: "projectFeed.php",
    data: {
      page: pageNumber
    },
  }).done(function (response) {
    $("#showFeed").html("");

    json = JSON.parse(response);
    projectData = json.projectData;
    creatorData = json.creatorData;
    followerData = json.followerData;
    totalProjects = json.totalRows;

    if (projectData.length !== 0) {
      var foundSearch = ('<ul style= "float:right; font-size:12px; font-weight:bold; margin-top:8px;"><li style="display:inline; margin-left:10px;"> <select class="styled-select" id="sortByInitiative" onchange="Sort(this.value, 1)" style="font-size:12px; width:auto"><option value="" selected="selected">Sort By</option><option value ="current">Active Initiatives</option><option value="finished">Completed Initiatives</option><option value ="newest">Newest</option><option value="oldest">Oldest</option><option value ="low-to-high">Budget (Low to High)</option><option value="high-to-low">Budget (High to Low)</option></select></li><li style="display:inline; margin-left:10px;"><form onsubmit="sortByLocation(); return false;" style="display:inline"><input id = "sortLocation" class="form-control" style="width:100px;  display:inline" type="search" name="sortLocation"  value = "" placeholder="Location"></form></li></ul>');

      $("#showFeed").html(foundSearch);
      $("#feed").html("");
      for (var i = 0; i < projectData.length; i++) {
        var projectId = (projectData[i].ID);
        var projectName = (projectData[i].NAME);
        var projectBlurb = (projectData[i].SHORT_BLURB);
        var category = (projectData[i].CATEGORY);
        var image = (projectData[i].IMAGE);
        var location = (projectData[i].LOCATION);
        var country = (projectData[i].COUNTRY == "") ? "": (","+" "+projectData[i].COUNTRY);
        var budget = (projectData[i].FUNDING);
        var description = (projectData[i].DESCRIPTION);
        var benefit = (projectData[i].BENEFIT);
        var challenges = (projectData[i].RISKS_CHALLENGES);
        var progreePercentage = (projectData[i].PROGRESS_PERCENTAGE);
        var videoLink = (projectData[i].VIDEO);
        var Svlink = "'" + videoLink + "'";
        var publishStatus = (projectData[i].PUBLISH_STATUS); 
        if (videoLink != "") {
          var videoIcon = '<a href="" data-toggle="modal" data-target="#videoModal" onClick="showVideo(' + Svlink + ')"><i class="icon-facetime-video pull-right"></i></a>';
        } else {
          var videoIcon = '';
        }
        var idForBlurb = i + 999;
        var readMore = '<a onclick="showDescription(' + projectId + ',10)"> more...</a>';
        var projectBlurb = projectBlurb.substring(0, 120) + readMore;

        for (var j = creatorData.length - 1; j >= 0; j--) {
          if (projectId == creatorData[j].PROJECT_ID) {
            var creator = ($.trim(creatorData[j].CREATOR_NAME).length >=16) ? (creatorData[j].CREATOR_NAME).split(' ').slice(0, -1).join(' '): $.trim(creatorData[j].CREATOR_NAME);
            var creatorEmail = creatorData[j].CREATOR_EMAIL;
            var creatorUWC = acronymUWC($.trim(creatorData[j].CREATOR_UWC));
            var creatorUWCYear = (creatorData[j].CREATOR_UWC_YEAR == 0) ? "": ("'"+creatorData[j].CREATOR_UWC_YEAR.slice(-2));
          }
        }
        var follower = 0;
        for (var j = followerData.length - 1; j >= 0; j--) {
          if (projectId == followerData[j].PROJECT_ID) {
            follower++;
          }
        }

        if (uid == "" || uid == null) {
          var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN" id = "UWCshortForm">'+creatorUWC +" "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a href="../login_page.php" class="btn btn-warning tm_style_4 pull-right" >Follow ' + follower + '</a> </div></section></div></div></li>';
        } else {
          var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + ''+ country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a class="btn btn-warning tm_style_4 pull-right " onClick="actionForm(' + projectId + ',0)">Follow ' + follower + '</a> </div></section></div></div></li>';
        }
        if (publishStatus == "now"){
          $('#feed').append(column);
        }
      }
      $("#totalProjectPagination").html("");
      $("#totalProjectPagination").html("");
      var searchPageCounter = parseInt(totalProjects / 12) + 1;
      if (searchPageCounter > 1) {
        $("#totalProjectPagination").append('<li><a class="first" onclick="helpInitiative(1)">First</a></li>');
        for (var l = 1; l <= searchPageCounter; l++) {
          $("#totalProjectPagination").append('<li><a onclick="helpInitiative(' + l + ')">' + l + '</a></li>');
        }
        $("#totalProjectPagination").append('<li><a class="last" onclick="helpInitiative(' + searchPageCounter + ')">Last</a></li>');
      }
    }
  });
}

function Sort(tag, pageNumber) {
  if ((tag=="current") || (tag =="finished")){
    sortInitiative(tag, pageNumber);
  } else {
    if ((tag=="newest") || (tag =="oldest")){
      sortBy(tag, 0, pageNumber);
    } else if ((tag=="low-to-high") || (tag =="high-to-low")){
      sortBy(tag, 1, pageNumber);
    }
  }
}

function acronymUWC(fullUWC){
  var acronymUWC;
  switch (fullUWC) {
    case "Online UWC":
        acronymUWC = "Online UWC";
        break;
    case "Waterford Kamhlaba UWC":
        acronymUWC = "WKUWCSA";
        break;
    case "Li Po Chun UWC":
        acronymUWC = "LPCUWC";
        break;
    case "UWC Mahindra College":
        acronymUWC = "MUWCI";
        break;
    case "UWC South East Asia":
        acronymUWC = "UWCSEA";
        break;
    case "UWC Adriatic":
        acronymUWC = "UWCAD";
        break;
    case "UWC Atlantic College":
        acronymUWC = "UWCAC";
        break;
    case "UWC Dilijan":
        acronymUWC = "Dilijan";
        break;
    case "UWC Maastricht":
        acronymUWC = "Maastricht";
        break;
    case "UWC in Mostar":
        acronymUWC = "Mostar";
        break;
    case "UWC Red Cross Nordic":
        acronymUWC = "UWCRCN";
        break;
    case "UWC Robert Bosch College":
        acronymUWC = "UWCRBC";
        break;
    case "Pearson College UWC":
        acronymUWC = "Pearson";
        break;
    case "UWC-USA":
        acronymUWC = "UWC-USA";
        break;
    case "UWC Costa Rica":
        acronymUWC = "UWCCRC";
        break;
    case "Short Programs":
        acronymUWC = "Short Prog.";
        break;
    case "UWC Associate":
        acronymUWC = "Associate";
        break;
    case "UWC Faculty":
        acronymUWC = "Faculty";
        break;
    case "UWC Staff":
        acronymUWC = "Staff";
        break;
    default:
       acronymUWC = " ";
  }
  return acronymUWC;
}



function sortInitiative(tag, pageNumber) {
  $("#feed").html("");
  $("#totalProjectPagination").html("");
  var newTag = (tag=="current")? "Active Initiatives": "Completed Initiatives";
  $("#title").html(newTag);
  $.ajax({
    type: "POST",
    url: "currentFinishedProjects.php",
    data: {
      tag: tag,
      page: pageNumber
    },
  }).done(function (response) {
    $("#showFeed").html("");

    json = JSON.parse(response);
    projectData = json.projectData;
    creatorData = json.creatorData;
    followerData = json.followerData;
    totalProjects = json.totalRows;

    if (projectData.length !== 0) {
      var foundSearch = ('<ul style= "float:right; font-size:12px; font-weight:bold; margin-top:8px;"><li style="display:inline; margin-left:10px;"> <select class="styled-select" id="sortByInitiative" onchange="Sort(this.value, 1)" style="font-size:12px; width:auto"><option value="" selected="selected">Sort By</option><option value ="current">Active Initiatives</option><option value="finished">Completed Initiatives</option><option value ="newest">Newest</option><option value="oldest">Oldest</option><option value ="low-to-high">Budget (Low to High)</option><option value="high-to-low">Budget (High to Low)</option></select></li><li style="display:inline; margin-left:10px;"><form onsubmit="sortByLocation(); return false;" style="display:inline"><input id = "sortLocation" class="form-control" style="width:100px;  display:inline" type="search" name="sortLocation"  value = "" placeholder="Location"></form></li></ul>');

      $("#showFeed").html(foundSearch);
      $("#feed").html("");
      for (var i = 0; i < projectData.length; i++) {
        var projectId = (projectData[i].ID);
        var projectName = (projectData[i].NAME);
        var projectBlurb = (projectData[i].SHORT_BLURB);
        var category = (projectData[i].CATEGORY);
        var image = (projectData[i].IMAGE);
        var location = (projectData[i].LOCATION);
        var country = (projectData[i].COUNTRY == "") ? "": (","+" "+projectData[i].COUNTRY);
        var budget = (projectData[i].FUNDING);
        var description = (projectData[i].DESCRIPTION);
        var benefit = (projectData[i].BENEFIT);
        var challenges = (projectData[i].RISKS_CHALLENGES);
        var progreePercentage = (projectData[i].PROGRESS_PERCENTAGE);
        var videoLink = (projectData[i].VIDEO);
        var Svlink = "'" + videoLink + "'";
        var publishStatus = (projectData[i].PUBLISH_STATUS); 
        if (videoLink != "") {
          var videoIcon = '<a href="" data-toggle="modal" data-target="#videoModal" onClick="showVideo(' + Svlink + ')"><i class="icon-facetime-video pull-right"></i></a>';
        } else {
          var videoIcon = '';
        }
        var idForBlurb = i + 999;
        var readMore = '<a onclick="showDescription(' + projectId + ',10)"> more...</a>';
        var projectBlurb = projectBlurb.substring(0, 120) + readMore;

        for (var j = creatorData.length - 1; j >= 0; j--) {
          if (projectId == creatorData[j].PROJECT_ID) {
            var creator = ($.trim(creatorData[j].CREATOR_NAME).length >=16) ? (creatorData[j].CREATOR_NAME).split(' ').slice(0, -1).join(' '): $.trim(creatorData[j].CREATOR_NAME);
            var creatorEmail = creatorData[j].CREATOR_EMAIL;
            var creatorUWC = acronymUWC($.trim(creatorData[j].CREATOR_UWC));
            var creatorUWCYear = (creatorData[j].CREATOR_UWC_YEAR == 0) ? "": ("'"+creatorData[j].CREATOR_UWC_YEAR.slice(-2));
          }
        }
        var follower = 0;
        for (var j = followerData.length - 1; j >= 0; j--) {
          if (projectId == followerData[j].PROJECT_ID) {
            follower++;
          }
        }

        if (uid == "" || uid == null) {
          var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a href="../login_page.php" class="btn btn-warning tm_style_4 pull-right" >Follow ' + follower + '</a> </div></section></div></div></li>';
        } else {
          var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a class="btn btn-warning tm_style_4 pull-right " onClick="actionForm(' + projectId + ',0)">Follow ' + follower + '</a> </div></section></div></div></li>';
        }
        if (publishStatus == "now") { 

         $('#feed').append(column);
        }
      }
      $("#totalProjectPagination").html("");
      var searchPageCounter = parseInt(totalProjects / 12) + 1;
      if (searchPageCounter > 1) {
        $("#totalProjectPagination").append('<li><a class="first" onclick="sortInitiative(\''+tag+'\', 1)">First</a></li>');
        for (var l = 1; l <= searchPageCounter; l++) {
          $("#totalProjectPagination").append('<li><a onclick="sortInitiative(\''+tag+'\', '+l+')">' + l + '</a></li>');
        }
        $("#totalProjectPagination").append('<li><a class="last" onclick="sortInitiative(\''+tag+'\', ' + searchPageCounter + ')">Last</a></li>');
      }
    }
  });
}

function sortCategory(event, pageNumber) {
  var category = event.target.text;
  $("#feed").html("");
  $("#totalProjectPagination").html("");
  $("#title").html(category);
  $.ajax({
    type: "POST",
    url: "projectFeed.php",
    data: {
      sortByIndex: "2",
      category: category, 
      page: pageNumber
    },
  }).done(function (response) {
    $("#showFeed").html("");

    json = JSON.parse(response);
    projectData = json.projectData;
    creatorData = json.creatorData;
    followerData = json.followerData;
    totalProjects = json.totalRows; 

    if (projectData.length !== 0) {
      var foundSearch = ('<ul style= "float:right; font-size:12px; font-weight:bold; margin-top:8px;"><li style="display:inline; margin-left:10px;"> <select class="styled-select" id="sortByInitiative" onchange="Sort(this.value, 1)" style="font-size:12px; width:auto"><option value="" selected="selected">Sort By</option><option value ="current">Active Initiatives</option><option value="finished">Completed Initiatives</option><option value ="newest">Newest</option><option value="oldest">Oldest</option><option value ="low-to-high">Budget (Low to High)</option><option value="high-to-low">Budget (High to Low)</option></select></li><li style="display:inline; margin-left:10px;"><form onsubmit="sortByLocation(); return false;" style="display:inline"><input id = "sortLocation" class="form-control" style="width:100px;  display:inline" type="search" name="sortLocation"  value = "" placeholder="Location"></form></li></ul>');

      $("#showFeed").html(foundSearch);
      $("#feed").html("");
      for (var i = 0; i < projectData.length; i++) {
        var projectId = (projectData[i].ID);
        var projectName = (projectData[i].NAME);
        var projectBlurb = (projectData[i].SHORT_BLURB);
        var category = (projectData[i].CATEGORY);
        var image = (projectData[i].IMAGE);
        var location = (projectData[i].LOCATION);
        var country = (projectData[i].COUNTRY == "") ? "": (","+" "+projectData[i].COUNTRY);
        var budget = (projectData[i].FUNDING);
        var description = (projectData[i].DESCRIPTION);
        var benefit = (projectData[i].BENEFIT);
        var challenges = (projectData[i].RISKS_CHALLENGES);
        var progreePercentage = (projectData[i].PROGRESS_PERCENTAGE);
        var videoLink = (projectData[i].VIDEO);
        var Svlink = "'" + videoLink + "'";
        var publishStatus = (projectData[i].PUBLISH_STATUS); 
        if (videoLink != "") {
          var videoIcon = '<a href="" data-toggle="modal" data-target="#videoModal" onClick="showVideo(' + Svlink + ')"><i class="icon-facetime-video pull-right"></i></a>';
        } else {
          var videoIcon = '';
        }
        var idForBlurb = i + 999;
        var readMore = '<a onclick="showDescription(' + projectId + ',10)"> more...</a>';
        var projectBlurb = projectBlurb.substring(0, 120) + readMore;

        for (var j = creatorData.length - 1; j >= 0; j--) {
          if (projectId == creatorData[j].PROJECT_ID) {
            var creator = ($.trim(creatorData[j].CREATOR_NAME).length >=16) ? (creatorData[j].CREATOR_NAME).split(' ').slice(0, -1).join(' '): $.trim(creatorData[j].CREATOR_NAME);
            var creatorEmail = creatorData[j].CREATOR_EMAIL;
            var creatorUWC = acronymUWC($.trim(creatorData[j].CREATOR_UWC));
            var creatorUWCYear = (creatorData[j].CREATOR_UWC_YEAR == 0) ? "": ("'"+creatorData[j].CREATOR_UWC_YEAR.slice(-2));
          }
        }
        var follower = 0;
        for (var j = followerData.length - 1; j >= 0; j--) {
          if (projectId == followerData[j].PROJECT_ID) {
            follower++;
          }
        }

        if (uid == "" || uid == null) {
          var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a href="../login_page.php" class="btn btn-warning tm_style_4 pull-right" >Follow ' + follower + '</a> </div></section></div></div></li>';
        } else {
          var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a class="btn btn-warning tm_style_4 pull-right " onClick="actionForm(' + projectId + ',0)">Follow ' + follower + '</a> </div></section></div></div></li>';
        }
        if (publishStatus == "now") { 

          $('#feed').append(column);
        }
      }
    } else {
      if (uid == "" || uid == null) {
        var column = '<li style="list-style-type:none; margin-bottom:35px"><div><section><div><h6 style="text-align:center;">Sorry, there are no projects in this category.  <a href="../login_page.php" class="btn btn-1">Create Your Own</a></h6></div></section></div></li>';
      } else {
        var column = '<li style="list-style-type:none; margin-bottom:35px"><div><section><div><h6 style="text-align:center;">Sorry, there are no projects in this category.  <a href="#tab4" data-toggle="tab" class="btn btn-1">Create Your Own</a></h6></div></section></div></li>';
      }
      $('#feed').append(column);
    }
    $("#totalProjectPagination").html("");
    var searchPageCounter = parseInt(totalProjects / 12) + 1;
    if (searchPageCounter > 1) {
      $("#totalProjectPagination").append('<li><a class="first" onclick="sortCategory(event, 1)">First</a></li>');
      for (var l = 1; l <= searchPageCounter; l++) {
        $("#totalProjectPagination").append('<li><a onclick="sortCategory(event, '+l+')">' + l + '</a></li>');
      }
      $("#totalProjectPagination").append('<li><a class="last" onclick="sortCategory( event, ' + searchPageCounter + ')">Last</a></li>');
    }
  });
}

function searchSubmit(event) {
  var input = $("#searchInput").val();
  event.preventDefault();

  $("#feed").html("");
  $("#totalProjectPagination").html("");
  $("#title").html(input);
  $.ajax({
    url: 'searchResult.php',
    type: "POST",
    data: {
      "searchInput": input
    }
  }).done(function (response) {
    $("#showFeed").html("");

    json = JSON.parse(response);
    projectData = json.projectData;
    creatorData = json.creatorData;
    followerData = json.followerData;
    totalProjects = json.totalRows;

    if (projectData.length !== 0) {
      var foundSearch = ('<ul style= "float:right; font-size:12px; font-weight:bold; margin-top:8px;"><li style="display:inline; margin-left:10px;"> <select class="styled-select" id="sortByInitiative" onchange="Sort(this.value, 1)" style="font-size:12px; width:auto"><option value="" selected="selected">Sort By</option><option value ="current">Active Initiatives</option><option value="finished">Completed Initiatives</option><option value ="newest">Newest</option><option value="oldest">Oldest</option><option value ="low-to-high">Budget (Low to High)</option><option value="high-to-low">Budget (High to Low)</option></select></li><li style="display:inline; margin-left:10px;"><form onsubmit="sortByLocation(); return false;" style="display:inline"><input id = "sortLocation" class="form-control" style="width:100px;  display:inline" type="search" name="sortLocation"  value = "" placeholder="Location"></form></li></ul>');

      $("#showFeed").html(foundSearch);
      $("#feed").html("");
      for (var i = 0; i < projectData.length; i++) {
        var projectId = (projectData[i].ID);
        var projectName = (projectData[i].NAME);
        var projectBlurb = (projectData[i].SHORT_BLURB);
        var category = (projectData[i].CATEGORY);
        var image = (projectData[i].IMAGE);
        var location = (projectData[i].LOCATION);
        var country = (projectData[i].COUNTRY == "") ? "": (","+" "+projectData[i].COUNTRY);
        var budget = (projectData[i].FUNDING);
        var description = (projectData[i].DESCRIPTION);
        var benefit = (projectData[i].BENEFIT);
        var challenges = (projectData[i].RISKS_CHALLENGES);
        var progreePercentage = (projectData[i].PROGRESS_PERCENTAGE);
        var videoLink = (projectData[i].VIDEO);
        var Svlink = "'" + videoLink + "'";
        var publishStatus = (projectData[i].PUBLISH_STATUS); 
        if (videoLink != "") {
          var videoIcon = '<a href="" data-toggle="modal" data-target="#videoModal" onClick="showVideo(' + Svlink + ')"><i class="icon-facetime-video pull-right"></i></a>';
        } else {
          var videoIcon = '';
        }
        var idForBlurb = i + 999;
        var readMore = '<a onclick="showDescription(' + projectId + ',10)"> more...</a>';
        var projectBlurb = projectBlurb.substring(0, 120) + readMore;

        for (var j = creatorData.length - 1; j >= 0; j--) {
          if (projectId == creatorData[j].PROJECT_ID) {
            var creator = ($.trim(creatorData[j].CREATOR_NAME).length >=16) ? (creatorData[j].CREATOR_NAME).split(' ').slice(0, -1).join(' '): $.trim(creatorData[j].CREATOR_NAME);
            var creatorEmail = creatorData[j].CREATOR_EMAIL;
            var creatorUWC = acronymUWC($.trim(creatorData[j].CREATOR_UWC));
            var creatorUWCYear = (creatorData[j].CREATOR_UWC_YEAR == 0) ? "": ("'"+creatorData[j].CREATOR_UWC_YEAR.slice(-2));
          }
        }
        var follower = 0;
        for (var j = followerData.length - 1; j >= 0; j--) {
          if (projectId == followerData[j].PROJECT_ID) {
            follower++;
          }
        }

        if (uid == "" || uid == null) {
          var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a href="../login_page.php" class="btn btn-warning tm_style_4 pull-right" >Follow ' + follower + '</a> </div></section></div></div></li>';
        } else {
          var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a class="btn btn-warning tm_style_4 pull-right " onClick="actionForm(' + projectId + ',0)">Follow ' + follower + '</a> </div></section></div></div></li>';
        }
        if (publishStatus == "now") { 

         $('#feed').append(column);
        }
      }
      $("#totalProjectPagination").html("");
      var searchPageCounter = parseInt(totalProjects / 12) + 1;
      if (searchPageCounter > 1) {
        $("#totalProjectPagination").append('<li><a class="first" onclick="sortInitiative(\''+tag+'\', 1)">First</a></li>');
        for (var l = 1; l <= searchPageCounter; l++) {
          $("#totalProjectPagination").append('<li><a onclick="sortInitiative(\''+tag+'\', '+l+')">' + l + '</a></li>');
        }
        $("#totalProjectPagination").append('<li><a class="last" onclick="sortInitiative(\''+tag+'\', ' + searchPageCounter + ')">Last</a></li>');
      }
    } else {
      $("#title").html('No result for ' + input);
    }
  });
}


function sortBy(tag, sortByIndex, pageNumber) {
  //sortByIndex: 0 = date, 1 = budget, 2 = category;
  if (sortByIndex == 0) {
    $("#feed").html("");
    $("#totalProjectPagination").html("");
    var newTag = (tag=="newest")? "Newest Initiatives": "Oldest Initiatives";
    $("#title").html(newTag);
    $.ajax({
      type: "POST",
      url: "projectFeed.php",
      data: {
        sortByIndex: "0",
        date: tag,
        page: pageNumber
      },
    }).done(function (response) {
      $("#showFeed").html("");

      json = JSON.parse(response);
      projectData = json.projectData;
      creatorData = json.creatorData;
      followerData = json.followerData;
      totalProjects = json.totalRows;

      if (projectData.length !== 0) {
        var foundSearch = ('<ul style= "float:right; font-size:12px; font-weight:bold; margin-top:8px;"><li style="display:inline; margin-left:10px;"> <select class="styled-select" id="sortByInitiative" onchange="Sort(this.value, 1)" style="font-size:12px; width:auto"><option value="" selected="selected">Sort By</option><option value ="current">Active Initiatives</option><option value="finished">Completed Initiatives</option><option value ="newest">Newest</option><option value="oldest">Oldest</option><option value ="low-to-high">Budget (Low to High)</option><option value="high-to-low">Budget (High to Low)</option></select></li><li style="display:inline; margin-left:10px;"><form onsubmit="sortByLocation(); return false;" style="display:inline"><input id = "sortLocation" class="form-control" style="width:100px;  display:inline" type="search" name="sortLocation"  value = "" placeholder="Location"></form></li></ul>');

        $("#showFeed").html(foundSearch);
        $("#feed").html("");
        for (var i = 0; i < projectData.length; i++) {
          var projectId = (projectData[i].ID);
          var projectName = (projectData[i].NAME);
          var projectBlurb = (projectData[i].SHORT_BLURB);
          var category = (projectData[i].CATEGORY);
          var image = (projectData[i].IMAGE);
          var location = (projectData[i].LOCATION);
          var country = (projectData[i].COUNTRY == "") ? "": (","+" "+projectData[i].COUNTRY);
          var budget = (projectData[i].FUNDING);
          var description = (projectData[i].DESCRIPTION);
          var benefit = (projectData[i].BENEFIT);
          var challenges = (projectData[i].RISKS_CHALLENGES);
          var progreePercentage = (projectData[i].PROGRESS_PERCENTAGE);
          var videoLink = (projectData[i].VIDEO);
          var Svlink = "'" + videoLink + "'";
          var publishStatus = (projectData[i].PUBLISH_STATUS); 
          if (videoLink != ""){ 
            var videoIcon = '<a href="" data-toggle="modal" data-target="#videoModal" onClick="showVideo(' + Svlink + ')"><i class="icon-facetime-video pull-right"></i></a>';
          } else {
            var videoIcon = '';
          }
          var idForBlurb = i + 999;
          var readMore = '<a onclick="showDescription(' + projectId + ',10)"> more...</a>';
          var projectBlurb = projectBlurb.substring(0, 120) + readMore;

          for (var j = creatorData.length - 1; j >= 0; j--) {
            if (projectId == creatorData[j].PROJECT_ID) {
              var creator = ($.trim(creatorData[j].CREATOR_NAME).length >=16) ? (creatorData[j].CREATOR_NAME).split(' ').slice(0, -1).join(' '): $.trim(creatorData[j].CREATOR_NAME);
              var creatorEmail = creatorData[j].CREATOR_EMAIL;
              var creatorUWC = acronymUWC($.trim(creatorData[j].CREATOR_UWC));
              var creatorUWCYear = (creatorData[j].CREATOR_UWC_YEAR == 0) ? "": ("'"+creatorData[j].CREATOR_UWC_YEAR.slice(-2));
            }
          }
          var follower = 0;
          for (var j = followerData.length - 1; j >= 0; j--) {
            if (projectId == followerData[j].PROJECT_ID) {
              follower++;
            }
          }

          if (uid == "" || uid == null) {
            var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a href="../login_page.php" class="btn btn-warning tm_style_4 pull-right" >Follow ' + follower + '</a> </div></section></div></div></li>';
          } else {
            var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a class="btn btn-warning tm_style_4 pull-right " onClick="actionForm(' + projectId + ',0)">Follow ' + follower + '</a> </div></section></div></div></li>';
          }
          if (publishStatus == "now") { 

            $('#feed').append(column);
          }
        }
        $("#totalProjectPagination").html("");
        var searchPageCounter = parseInt(totalProjects / 12) + 1;
        if (searchPageCounter > 1) {
          $("#totalProjectPagination").append('<li><a class="first" onclick="sortBy(\''+tag+'\', 0, 1)">First</a></li>');
          for (var l = 1; l <= searchPageCounter; l++) {
            $("#totalProjectPagination").append('<li><a onclick="sortBy(\''+tag+'\', 0, ' + l + ')">' + l + '</a></li>');
          }
          $("#totalProjectPagination").append('<li><a class="last" onclick="sortBy(\''+tag+'\', 0, ' + searchPageCounter + ')">Last</a></li>');
        }
      }
    });
  } else if (sortByIndex == 1) {
    $("#feed").html("");
    $("#totalProjectPagination").html("");
    var newTag = (tag=="low-to-high")? "Low Budget Initiatives": "High Budget Initiatives";
    $("#title").html(newTag);
    $.ajax({
      type: "POST",
      url: "projectFeed.php",
      data: {
        sortByIndex: "1",
        budget: tag,
        page: pageNumber
      },
    }).done(function (response) {
      $("#showFeed").html("");

      json = JSON.parse(response);
      projectData = json.projectData;
      creatorData = json.creatorData;
      followerData = json.followerData;
      totalProjects = json.totalRows;

      if (projectData.length !== 0) {
        var foundSearch = ('<ul style= "float:right; font-size:12px; font-weight:bold; margin-top:8px;"><li style="display:inline; margin-left:10px;"> <select class="styled-select" id="sortByInitiative" onchange="Sort(this.value, 1)" style="font-size:12px; width:auto"><option value="" selected="selected">Sort By</option><option value ="current">Active Initiatives</option><option value="finished">Completed Initiatives</option><option value ="newest">Newest</option><option value="oldest">Oldest</option><option value ="low-to-high">Budget (Low to High)</option><option value="high-to-low">Budget (High to Low)</option></select></li><li style="display:inline; margin-left:10px;"><form onsubmit="sortByLocation(); return false;" style="display:inline"><input id = "sortLocation" class="form-control" style="width:100px;  display:inline" type="search" name="sortLocation"  value = "" placeholder="Location"></form></li></ul>');

      $("#showFeed").html(foundSearch);
      $("#feed").html("");
      for (var i = 0; i < projectData.length; i++) {
        var projectId = (projectData[i].ID);
        var projectName = (projectData[i].NAME);
        var projectBlurb = (projectData[i].SHORT_BLURB);
        var category = (projectData[i].CATEGORY);
        var image = (projectData[i].IMAGE);
        var location = (projectData[i].LOCATION);
        var country = (projectData[i].COUNTRY == "") ? "": (","+" "+projectData[i].COUNTRY);
        var budget = (projectData[i].FUNDING);
        var description = (projectData[i].DESCRIPTION);
        var benefit = (projectData[i].BENEFIT);
        var challenges = (projectData[i].RISKS_CHALLENGES);
        var progreePercentage = (projectData[i].PROGRESS_PERCENTAGE);
        var videoLink = (projectData[i].VIDEO);
        var Svlink = "'" + videoLink + "'";
        var publishStatus = (projectData[i].PUBLISH_STATUS); 
        if (videoLink != "") {
          var videoIcon = '<a href="" data-toggle="modal" data-target="#videoModal" onClick="showVideo(' + Svlink + ')"><i class="icon-facetime-video pull-right"></i></a>';
        } else {
          var videoIcon = '';
        }
        var idForBlurb = i + 999;
        var readMore = '<a onclick="showDescription(' + projectId + ',10)"> more...</a>';
        var projectBlurb = projectBlurb.substring(0, 120) + readMore;

        for (var j = creatorData.length - 1; j >= 0; j--) {
          if (projectId == creatorData[j].PROJECT_ID) {
            var creator = ($.trim(creatorData[j].CREATOR_NAME).length >=16) ? (creatorData[j].CREATOR_NAME).split(' ').slice(0, -1).join(' '): $.trim(creatorData[j].CREATOR_NAME);
            var creatorEmail = creatorData[j].CREATOR_EMAIL;
            var creatorUWC = acronymUWC($.trim(creatorData[j].CREATOR_UWC));
            var creatorUWCYear = (creatorData[j].CREATOR_UWC_YEAR == 0) ? "": ("'"+creatorData[j].CREATOR_UWC_YEAR.slice(-2));
          }
        }
        var follower = 0;
        for (var j = followerData.length - 1; j >= 0; j--) {
          if (projectId == followerData[j].PROJECT_ID) {
            follower++;
          }
        }

          if (uid == "" || uid == null) {
            var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a href="../login_page.php" class="btn btn-warning tm_style_4 pull-right" >Follow ' + follower + '</a> </div></section></div></div></li>';
          } else {
            var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a class="btn btn-warning tm_style_4 pull-right " onClick="actionForm(' + projectId + ',0)">Follow ' + follower + '</a> </div></section></div></div></li>';
          }
          if (publishStatus == "now") { 

            $('#feed').append(column);
          }
        }
        $("#totalProjectPagination").html("");
        var searchPageCounter = parseInt(totalProjects / 12) + 1;
        if (searchPageCounter > 1) {
          $("#totalProjectPagination").append('<li><a class="first" onclick="sortBy(\''+tag+'\', 1, 1)">First</a></li>');
          for (var l = 1; l <= searchPageCounter; l++) {
            $("#totalProjectPagination").append('<li><a onclick="sortBy(\''+tag+'\', 1, ' + l + ')">' + l + '</a></li>');
          }
          $("#totalProjectPagination").append('<li><a class="last" onclick="sortBy(\''+tag+'\', 1,' + searchPageCounter + ')">Last</a></li>');
        }
      }
    });
  }
}

function sortByLocation() {
  var $sortLocation = $("#sortLocation").val();
  $("#feed").html("");
  $("#totalProjectPagination").html("");
  if ($sortLocation.length !== 0) {
    $.ajax({
      type: "POST",
      url: "locationSort.php",
      data: {
        sortLocation: $sortLocation
      },
    }).done(function (response) {
      $("#showFeed").html("");

      json = JSON.parse(response);
      projectData = json.projectData;
      creatorData = json.creatorData;
      followerData = json.followerData;
      totalProjects = json.totalRows;

      if (projectData.length !== 0) {
        var foundSearch = ('<ul style= "float:right; font-size:12px; font-weight:bold; margin-top:8px;"><li style="display:inline; margin-left:10px;"> <select class="styled-select" id="sortByInitiative" onchange="Sort(this.value, 1)" style="font-size:12px; width:auto"><option value="" selected="selected">Sort By</option><option value ="current">Active Initiatives</option><option value="finished">Completed Initiatives</option><option value ="newest">Newest</option><option value="oldest">Oldest</option><option value ="low-to-high">Budget (Low to High)</option><option value="high-to-low">Budget (High to Low)</option></select></li><li style="display:inline; margin-left:10px;"><form onsubmit="sortByLocation(); return false;" style="display:inline"><input id = "sortLocation" class="form-control" style="width:100px;  display:inline" type="search" name="sortLocation"  value = "" placeholder="Location"></form></li></ul>');

        $("#showFeed").html(foundSearch);
        $("#feed").html("");
        for (var i = 0; i < projectData.length; i++) {
          var projectId = (projectData[i].ID);
          var projectName = (projectData[i].NAME);
          var projectBlurb = (projectData[i].SHORT_BLURB);
          var category = (projectData[i].CATEGORY);
          var image = (projectData[i].IMAGE);
          var location = (projectData[i].LOCATION);
          var country = (projectData[i].COUNTRY == "") ? "": (","+" "+projectData[i].COUNTRY);
          var budget = (projectData[i].FUNDING);
          var description = (projectData[i].DESCRIPTION);
          var benefit = (projectData[i].BENEFIT);
          var challenges = (projectData[i].RISKS_CHALLENGES);
          var progreePercentage = (projectData[i].PROGRESS_PERCENTAGE);
          var videoLink = (projectData[i].VIDEO);
          var Svlink = "'" + videoLink + "'";
          var publishStatus = (projectData[i].PUBLISH_STATUS); 
          if (videoLink != "") {
            var videoIcon = '<a href="" data-toggle="modal" data-target="#videoModal" onClick="showVideo(' + Svlink + ')"><i class="icon-facetime-video pull-right"></i></a>';
          } else {
            var videoIcon = '';
          }
          var idForBlurb = i + 999;
          var readMore = '<a onclick="showDescription(' + projectId + ',10)"> more...</a>';
          var projectBlurb = projectBlurb.substring(0, 120) + readMore;

          for (var j = creatorData.length - 1; j >= 0; j--) {
            if (projectId == creatorData[j].PROJECT_ID) {
              var creator = ($.trim(creatorData[j].CREATOR_NAME).length >=16) ? (creatorData[j].CREATOR_NAME).split(' ').slice(0, -1).join(' '): $.trim(creatorData[j].CREATOR_NAME);
              var creatorEmail = creatorData[j].CREATOR_EMAIL;
              var creatorUWC = acronymUWC($.trim(creatorData[j].CREATOR_UWC));
              var creatorUWCYear = (creatorData[j].CREATOR_UWC_YEAR == 0) ? "": ("'"+creatorData[j].CREATOR_UWC_YEAR.slice(-2));
            }
          }
          var follower = 0;
          for (var j = followerData.length - 1; j >= 0; j--) {
            if (projectId == followerData[j].PROJECT_ID) {
              follower++;
            }
          }

          if (uid == "" || uid == null) {
            var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a href="../login_page.php" class="btn btn-warning tm_style_4 pull-right" >Follow ' + follower + '</a> </div></section></div></div></li>';
          } else {
            var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a class="btn btn-warning tm_style_4 pull-right " onClick="actionForm(' + projectId + ',0)">Follow ' + follower + '</a> </div></section></div></div></li>';
          }
          if (publishStatus == "now") { 

            $('#feed').append(column);
          }
        }
        $("#totalProjectPagination").html("");
        var searchPageCounter = parseInt(totalProjects / 12) + 1;
        if (searchPageCounter > 1) {
          $("#totalProjectPagination").append('<li><a class="first" onclick="sortInitiative(1)">First</a></li>');
          for (var l = 1; l <= searchPageCounter; l++) {
            $("#totalProjectPagination").append('<li><a onclick="sortInitiative(' + l + ')">' + l + '</a></li>');
          }
          $("#totalProjectPagination").append('<li><a class="last" onclick="sortInitiative(' + searchPageCounter + ')">Last</a></li>');
        }
      } else{
        if (uid == "" || uid == null) {
          var column = '<li style="list-style-type:none; margin-bottom:35px"><div><section><div><h6 style="text-align:center;">Sorry, there are no projects from '+$sortLocation+'.  <a href="../login_page.php" class="btn btn-1">Create Your Own</a></h6></div></section></div></li>';
          } else {
            var column = '<li style="list-style-type:none; margin-bottom:35px"><div><section><div><h6 style="text-align:center;">Sorry, there are no projects from '+$sortLocation+'.  <a href="#tab4" data-toggle="tab" class="btn btn-1">Create Your Own</a></h6></div></section></div></li>';
          }
        $('#feed').append(column);
      }
    });
    return false;
  }
};

function myProjects(pageNumber, tag) {
  if (tag == 'current') {
    var feedId = 'currentProject';
    var paginationId = 'currentProjectPagination';
  } else if (tag == 'past') {
    var feedId = 'pastProject';
    var paginationId = 'pastProjectPagination';
  } else if (tag == 'followed') {
    var feedId = 'followedProject';
    var paginationId = 'followedProjectPagination';
  }

  $("#feed").html("");
  $("#" + feedId).html("");
  $("#" + paginationId).html("");
  $.ajax({
    type: "POST",
    url: "myProjectFeed.php",
    data: {
      tag: tag,
      email: userEmail,
      page: pageNumber
    },
  }).done(function (response) {

    json = JSON.parse(response);
    projectData = json.projectData;
    creatorData = json.creatorData;
    followerData = json.followerData;
    totalProjects = projectData.length;

    if (projectData.length !== 0) {
      $("#" + feedId).html("");
      for (var i = 0; i < projectData.length; i++) {
        var projectId = (projectData[i].ID);
        var projectName = (projectData[i].NAME);
        var projectBlurb = (projectData[i].SHORT_BLURB);
        var category = (projectData[i].CATEGORY);
        var image = (projectData[i].IMAGE);
        var location = (projectData[i].LOCATION);
        var country = (projectData[i].COUNTRY == "") ? "": (","+" "+projectData[i].COUNTRY);
        var budget = (projectData[i].FUNDING);
        var description = (projectData[i].DESCRIPTION);
        var benefit = (projectData[i].BENEFIT);
        var challenges = (projectData[i].RISKS_CHALLENGES);
        var progreePercentage = (projectData[i].PROGRESS_PERCENTAGE);
        var videoLink = (projectData[i].VIDEO);
        var Svlink = "'" + videoLink + "'";
        if (videoLink != "") {
          var videoIcon = '<a href="" data-toggle="modal" data-target="#videoModal" onClick="showVideo(' + Svlink + ')"><i class="icon-facetime-video pull-right"></i></a>';
        } else {
          var videoIcon = '';
        }
        var idForBlurb = i + 999;
        var readMore = '<a onclick="showDescription(' + projectId + ',10)"> more...</a>';
        var projectBlurb = projectBlurb.substring(0, 120) + readMore;

        for (var j = creatorData.length - 1; j >= 0; j--) {
          if (projectId == creatorData[j].PROJECT_ID) {
            var creator = ($.trim(creatorData[j].CREATOR_NAME).length >=16) ? (creatorData[j].CREATOR_NAME).split(' ').slice(0, -1).join(' '): $.trim(creatorData[j].CREATOR_NAME);
            var creatorEmail = creatorData[j].CREATOR_EMAIL;
            var creatorUWC = acronymUWC($.trim(creatorData[j].CREATOR_UWC));
            var creatorUWCYear = (creatorData[j].CREATOR_UWC_YEAR == 0) ? "": ("'"+creatorData[j].CREATOR_UWC_YEAR.slice(-2));
          }
        }
        var follower = 0;
        for (var j = followerData.length - 1; j >= 0; j--) {
          if (projectId == followerData[j].PROJECT_ID) {
            follower++;
          }
        }

        if (tag == "followed") {
          var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',10)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',10)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a class="btn btn-warning tm_style_3 pull-right " onClick="actionForm(' + projectId + ',5)">Unfollow ' + follower + '</a> </div></section></div></div></li>';
        } else {
          var column = '<li style="list-style-type:none; margin-bottom:35px" class="span3 tm_curved-vt-2"><div class="tm_text-shadow"><div class="thumbnail thumbnail-1"><img onclick="showDescription(' + projectId + ',11)" src="uploads/' + image + '" alt="" style="cursor:pointer; width:270px; height:192px; margin-bottom:20px"><section> <div class="mid-right-box" style="vertical-align:bottom"><h5 style="min-height:50px"><a onclick="showDescription(' + projectId + ',11)">' + projectName + '</a><div>' + videoIcon + '</div></h5></div><div class="meta"><div class="name-author"><i class="icon-user"></i> <a onclick="showUserProfile(\'' + creatorEmail + '\')">' + creator + '</a></div><div class="uwc-name"><i class="icon-certificate"></i><a class="uwcN">'+creatorUWC + " "+'</a><a class="uwcY">'+creatorUWCYear +'</a></div></div><div class="clear"></div> <p id="' + idForBlurb + '" style="min-height:110px; text-align:left; font-size:12px; margin-bottom:-25px;">' + projectBlurb + '</p><div style="margin-bottom:20px;"><a class="comments"><i class="icon-map-marker"></i> <b>' + location + '' + country + '</b></a></div><div class="progress"><div data-percentage="0%" style="width: ' + progreePercentage + '%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><div style="padding-bottom:35px;" ><a class="btn btn-warning tm_style_3 pull-left " onClick="actionForm(' + projectId + ',3)">EDIT</a><a class="btn btn-warning tm_style_3 pull-right " onClick="actionForm(' + projectId + ',6)">DELETE</a> </div></section></div></div></li>';
        }
        $("#" + feedId).append(column);
      }
      $("#" + paginationId).html("");
      var searchPageCounter = parseInt(totalProjects / 12) + 1;
      if (searchPageCounter > 1) {
        $("#" + paginationId).append('<li><a class="first" onclick="myProjects(1, \'' + tag + '\')">First</a></li>');
        for (var l = 1; l <= searchPageCounter; l++) {
          $("#" + paginationId).append('<li><a onclick="myProjects(' + l + ', \'' + tag + '\')">' + l + '</a></li>');
        }
        $("#" + paginationId).append('<li><a class="last" onclick="myProjects(' + searchPageCounter + ', \'' + tag + '\')">Last</a></li>');
      }
    }
  });
}

function showDescription(shareBoardDescriptionId, descriptionId) {
  var shareBoardDescriptionId = shareBoardDescriptionId * 79.99;
  var descriptionId = descriptionId * 89.99;
  var uri = 'details.php?';
  var extraUri = 'PROJECT=' + shareBoardDescriptionId + '&ID=' + descriptionId;
  var encodedUri = encodeURIComponent(extraUri);
  var finalUri = uri + encodedUri;
  window.open(finalUri, '_self');
}

function showUserProfile(userEmail) {
  var newWindow = window.open('profile.php?' + encodeURIComponent('USEREMAIL=' + userEmail), '_self');
}

function submitInitiative(tag, id) {
  var $addProject = $("#projectName").val();
  var $category = $("#category option:selected").text();
  var $location = $("#location").val();
  var $country = $("#countryName").val();
  var $description = $("#description").val();
  var $creator1 = $("#creator1Name").val();
  var $creator1Email = $("#creator1Email").val();
  var $creatorUWC = $("#selectUWC").val();
  var $creatorUWCYear = $("#selectYear").val();
  var $projectData = new FormData($("#projectDescription")[0]);
  var $creatorData = new FormData($("#initiativeCreator")[0]);
  var $publishNow = $("#publishNow").val(); 
  var $publishLater = $("#publishLater").val(); 
  var radioButtons = document.getElementsByName("publishWhen"); 
  for (var i = 0; i < radioButtons.length; i++) { 
    if (radioButtons[i].checked) { 
     // alert(radioButtons[i].value); 
     var $publishStatus = radioButtons[i].value; 
   } 
 } 
  $projectData.append("radioValue", $publishStatus); 

  if (($.trim($addProject)).length !== 0 && ($.trim($category)).length !== 0 && ($.trim($location)).length !== 0 && ($.trim($description)).length !== 0 && ($.trim($creator1)).length !== 0 && ($.trim($creator1Email)).length !== 0 && ($.trim($creatorUWC)).length !== 0 && ($.trim($creatorUWCYear)).length !== 0) {
    if (tag == 'submit') {
      var url1 = "startInitiative.php";
      var url2 = "creatorInitiative.php";
    } else if (tag == 'update') {
      var url1 = "updateInitiative.php";
      var url2 = "updateCreators.php";
    }

    $('#submitInitiative').attr("disabled", true);
    $.ajax({
      type: "POST",
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      url: url1,
      data: $projectData
    }).done(function (response) {
      $('#submitSuccess').slideDown();

    });

    $.ajax({
      type: "POST",
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      url: url2,
      data: $creatorData
    }).done(function (response) {
      console.log(response);
    });

    // homeReturn();
    return false;

  } else {
    $("#fillAllRequiredFieldsAlert").slideDown();
    $('#submitInitiative').removeAttr("disabled");
    event.preventDefault();
  }
}



function actionForm(projectId, actionId) {
  if (actionId == 0) {
    $('#follow' + projectId).alert();
    $('#follow' + projectId).fadeTo(5000, 500).delay(10000).slideDown(5000, function () {
      $('#follow' + projectId).alert('close');
    });

    $.ajax({
      url: 'follow.php',
      type: "POST",
      data: {
        "projectId": projectId,
        "name" : userName,
        "email": userEmail,
        "follow": 1
      }
    }).done(function (response) {
      //if (response == 1){
        message = "Thanks for Following. You can keep track of it under 'My Initiatives' Tab."        
      // } else {
        // message = "You are already following this project. You can keep track of it under 'My Initiatives' Tab."
      // }
      $.notifyBar({
        cssClass: "success",
        delay: 3500,
        html: message
      });
      setInterval(helpInitiative(1),2000);
    })
  } else if (actionId == 5) {
    if (confirm("Are you sure about this?") == true) {
      $.ajax({
        url: 'follow.php',
        type: "POST",
        data: {
          "projectId": projectId,
          "email": userEmail,
          "follow": 0
        }
      }).done(function (response) {
        $.notifyBar({
          cssClass: "warning",
          html: "You are not following the initiative anymore."
        });
        setInterval(myProjects(1, "followed"),2000);
      })
    }
  } else if (actionId == 1) {
    $("#contactModal").modal("show");
    $("#submitContactForm").click(function () {
      contactProjectCreators(projectId);
    });
  } else if (actionId == 2) {
    alert("Coming soon !!!");
  } else if (actionId == 3) {
    projectId = projectId * 99.99; // Just for temporery secure encoding
    var uri = 'edit2.php?';
    var extraUri = 'PROJECT=' + projectId;
    var encodedUri = encodeURIComponent(extraUri);
    var finalUri = uri + encodedUri;
    window.open(finalUri, '_self');
  } else if (actionId == 4) {
    var confirmleave = confirm("Do you want to remove yourself from this project?");
    if (confirmleave == true) {
      $.ajax({
        url: 'leaveProject.php',
        type: "POST",
        data: {
          "projectId": projectId,
          "email": userEmail,
          "action": "leave"
        }
      }).done(function (response) {
        alert("You are no longer part of this project. ");
      })
    }
  } else if (actionId == 6) {
    var confirmleave = confirm("Are you sure you want to delete this project?");
    if (confirmleave == true) {
      // var passoword = prompt(userName + ", Please enter your passoword to confirm" );
      // $.ajax({
      //   url: 'leaveProject.php',
      //   type: "POST",
      //   data: {
      //     "passoword": passoword,
      //     "email": userEmail,
      //     "action": "confirm"
      //   }
      // }).done(function (response) {
      // });
        $.ajax({
          url: 'leaveProject.php',
          type: "POST",
          data: {
            "projectId": projectId,
            "email": userEmail,
            "action": "delete"
          }
        }).done(function (response) {
          alert("This project is now deleted.");
          homeReturn();
        })
    }
  }
}

function updateProfile() {
    var updateUserProfileData = new FormData($("#updateForm")[0]);
    updateUserProfileData.append("id", uid);
    $('#updateButton').attr("disabled", true);
    $.ajax({
      type: "POST",
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      url: "updateUserProfile.php",
      data: updateUserProfileData,
    }).done(function (response) {
      window.open('index.php', '_self');
    });
  }
  // Creates table with three-columns with the id provided...
  // funtioon CreateTable() is used to show the result of searched-item and myShareBOT

function CreateTable(table_Id, left_column, middle_column, right_column, rowId) {
  var row = document.getElementById(table_Id).insertRow(0); //Insert Row
  row.id = rowId;
  row.className = "classForTableRow";
  //Insert three columns into each row created.
  var left = row.insertCell(0);
  left.className = "leftColumn"
  var middle = row.insertCell(1);
  middle.className = "middleColumn"
  var right = row.insertCell(2);
  right.className = "rightColumn"// UWCnext: is a platform that allows UWC studens and alumnies to live their UWC dream...
//returns to main/home page...
  left.innerHTML = left_column;
  middle.innerHTML = middle_column;
  right.innerHTML = right_column;
}

// Creates table with three-columns with the id provided...
// funtioon CreateTable() is used to show the result of searched-item and myShareBOT
function CreateTableRow(table_Id, new_row) {
  var row = document.getElementById(table_Id).insertRow(0); //Insert Row
  row.innerHTML = new_row;
}