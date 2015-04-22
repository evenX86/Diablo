/**
 * Created by xuyifei01 on 2015/3/29.
 */
function auditList() {
    $.get("/restful/audit-list", function (result) {
        for (var i = 0; i < result.length; i++) {
            var audit = "未审核";
            if (result[i].prof_audit == "false") {
                audit = "审核未通过"
            } else if (result[i].prof_audit == "true") {
                audit = "本阶段已通过";
            }
            var comment;
            if (result[i].prof_comment != null && result[i].prof_comment != "null") {
                comment = result[i].prof_comment;
            } else {
                comment = "未填写审核意见";
            }
            $("#subject-content").append("<tr><td>" + result[i].id + "</td> <td>" + result[i].subject_title + "</td> <td>" + result[i].teacher_name + "(" + result[i].teacher_id + ")</td>" +
            " <td>" + audit + "</td> <td>" + comment + "</td> <td><button type=\"button\" class=\"btn \" data-toggle=\"modal\" data-target=\"#myModal\" onclick='writeModal(\"" + result[i].subject_title + "\",\"" + result[i].teacher_name + "\",\"" + result[i].teacher_id + "\",\"" + result[i].id + "\")'>" +
            "审核 </button></td> </tr>")
        }
    });
}

/**
 * 点击审核按钮之后改变模态框内容
 */
function writeModal(title, name, id,subjectID) {
    $("#subject-title-modal").val(title);
    $("#subject-teacher-modal").val(name);
    $("#subject-teacherid-modal").val(id);
    $("#subject-id-modal").val(subjectID);
}

$(document).ready(function () {
    auditList();
});

function ensureSelectList() {
    $.get("/restful/prof/ensure/list",function(result){
        for(var i=0;i<result.length;i++){
            $("#subject-enable").append("<tr><td>"+result[i].id+"</td> <td>"+result[i].subject_title+"</td>" +
            " <td>"+result[i].major+"</td> <td>"+result[i].student_id+"</td> <td> "+result[i].create_time+"</td><td><button type=\"button\" class=\"btn \" data-toggle=\"modal\" data-target=\"#myModal\" onclick='writeModal1(\"" + result[i].subject_title + "\",\"" + result[i].student_id+ "\",\"" +  result[i].id + "\")'>" +
            "确认 </button></td></tr>");
        }
    });
}


function writeModal1(title, id,subjectID) {
    $("#subject-title-modal").val(title);
    $("#subject-teacherid-modal").val(id);
    $("#subject-id-modal").val(subjectID);
}

function initEnv(i) {
    $("#category").children().eq(i).addClass("active");
}

function showStartRList() {
    $.get("/restful/prof/startr/list",function(result){
        for (var i = 0; i < result.length; i++) {
            var flag = 0;
            if (result[i].flag == 2) {
                $("#startr-list").append("<tr><td>" + result[i].id + "</td> <td>" + result[i].title + "</td>" +
                " <td>" + result[i].student + "</td> <td><a href='"+result[i].addr+"'>下载</a></td> <td> 指导教师已审核</td><td><button type=\"button\" class=\"btn \" data-toggle=\"modal\" data-target=\"#myModal\" onclick='StartRModal(\"" + result[i].id + "\",\"" + result[i].title + "\",\"" + result[i].student + "\")'>" +
                "审查 </button></td></tr>");
            } else if (result[i].flag == 1){
                $("#startr-list").append("<tr><td>" + result[i].id + "</td> <td>" + result[i].title + "</td>" +
                " <td>" + result[i].student + "</td><td><a href='"+result[i].addr+"'>下载</a></td><td> 已完成</td><td><button type=\"button\" class=\"btn disabled\" data-toggle=\"modal\" data-target=\"#myModal\" onclick='StartRModal(\"" + result[i].id + "\",\"" + result[i].title + "\",\"" + result[i].student + "\")'>" +
                "审查 </button></td></tr>");
            } else {
                $("#startr-list").append("<tr><td>" + result[i].id + "</td> <td>" + result[i].title + "</td>" +
                " <td>" + result[i].student + "</td><td><a href='"+result[i].addr+"'>下载</a></td><td> 指导教师未审核</td><td><button type=\"button\" class=\"btn disabled\" data-toggle=\"modal\" data-target=\"#myModal\" onclick='StartRModal(\"" + result[i].id + "\",\"" + result[i].title + "\",\"" + result[i].student + "\")'>" +
                "审查 </button></td></tr>");
            }

        }
    });
}

function StartRModal(id,report,name){
    $("#startr-id-modal").val(id);
    $("#startr-title-modal").val(report);
    $("#startr-student-modal").val(name);
}