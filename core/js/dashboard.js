var zTree;
var htmlContainer;
var zNodes;
var setting = {
    view: {
        dblClickExpand: true,
        showLine: false,
        selectedMulti: false
    },
    data: {
        simpleData: {
            enable: true,
            idKey: "id",
            pIdKey: "pId",
            rootPId: "",
            datatype: "type",
        }
    },
    callback: {
        beforeClick: function(treeId, treeNode) {
            console.log("Clicked node:", treeNode);
            var zTree = $.fn.zTree.getZTreeObj("tree");
            if (treeNode.isParent || treeNode.type === "folder") {

                window.location.hash = '#' + treeNode.file;
                return false;
            } else {

                window.open(treeNode.file, "_blank");
                return false;
            }
        }
    }
};

$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "list.php",
        dataType: "json",
        success: function(data) {
            zNodes = data;
            htmlContainer = $("#htmlContainer");
            var t = $("#tree");
            t = $.fn.zTree.init(t, setting, zNodes);
            var zTree = $.fn.zTree.getZTreeObj("tree");
            zTree.selectNode(zTree.getNodeByParam("pId", 0));
            var folderID = 0;
            var folderID2 = 0;
            console.log("Main ID ", folderID);

            if (hasHash(window.location.href)) {
                handleHashChange();
            } else {
                loadHTMLData('folder/0');
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching zTree data:", error);
        }
    });
    $("#searchInput").on("input", function() {
        var searchText = $(this).val();

        if (searchText.length > 1) {
            filterTree(searchText);
        } else {
            hideSearchResults();
        }
    });
    $(document).on("click", function(event) {

        if (!$(event.target).closest("#searchInput, #searchResults").length) {
            hideSearchResults();
        }
    });

    $("#searchButton").on("click", function() {

        $("#searchInputContainer").toggle();
        $("#main-navbar").toggle();
        if ($("#searchInputContainer").is(":visible")) {
            $("#searchInput").focus();
        }
    });

    $("#searchCloseButton").on("click", function() {

        $("#searchInputContainer").hide();
        $("#main-navbar").show();
    });
});

function filterTree(searchText) {
    var filteredNodes = zNodes.filter(function(node) {
        return node.name.toLowerCase().includes(searchText.toLowerCase());
    });

    var maxResults = Math.min(5, filteredNodes.length);

    console.log(filteredNodes.slice(0, maxResults));

    updateResultsUI(filteredNodes.slice(0, maxResults));
}

function updateResultsUI(results) {
    var searchResultsContainer = $("#searchResults");
    searchResultsContainer.empty();

    if (results.length > 0) {

        searchResultsContainer.show();

        var resultTemplate = "<a href='{href}' class='d-flex justify-content-start align-items-center my-3'>\
                                                <img src='/assets/svg/{type}.svg' style='width: 25px; height: 25px; margin-right: 10px;'>\
                                                <span class='result-name'>{name}</span>\
                                             </a>";

        results.forEach(function(result, index) {
            if (result.type == "folder") {
                var hrefs = "dashboard#" + result.id;
            } else {
                var hrefs = "file/" + result.id;
            }
            var resultHtml = resultTemplate
                .replace("{name}", result.name)
                .replace("{href}", hrefs)
                .replace("{type}", result.type);

            var resultElement = $(resultHtml);

            searchResultsContainer.append(resultElement);

            resultElement.on("click", function() {

                hideSearchResults();
            });

            if (index < results.length - 1) {
                searchResultsContainer.append("<hr>");
            }
        });

    } else {
        searchResultsContainer.html("<div>No results</div>");
        searchResultsContainer.show();
    }
}

function hideSearchResults() {
    $("#searchResults").hide();
}

function loadHTMLData(htmlURL) {

    fetch(htmlURL)
        .then(response => response.text())
        .then(htmlData => {
            htmlContainer.html(htmlData);
        })
        .catch(error => {
            console.error('Error fetching HTML data:', error);
        });
}

function hasHash(link) {
    return link.includes('#');
}

function handleHashChange() {
    var currentHash = window.location.hash;

    console.log('Hash changed to:', currentHash);
    currentHash = currentHash.substring(1);
    if (currentHash.length > 0) {
        folderID = parseInt(currentHash);
        folderID2 = parseInt(currentHash);
        console.log("change to ", folderID);
        loadHTMLData('folder/' + currentHash);
    } else {
        loadHTMLData('folder/0');
    }
}

window.addEventListener('hashchange', handleHashChange);