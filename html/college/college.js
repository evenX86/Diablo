/**
 * Created by xuyifei01 on 2015/3/29.
 */
function auditList() {
    $.get("/restful/college/subject-audit-list", function (result) {
        for (var i = 0; i < result.length; i++) {
            var audit = "未审核";
            if (result[i].college_audit == "false") {
                audit = "审核未通过"
            } else if (result[i].college_audit == "true") {
                audit = "本阶段已通过";
            }
            var comment,college_comment;
            if (result[i].prof_comment != null && result[i].prof_comment != "null") {
                comment = result[i].prof_comment;
            } else {
                comment = "未填写审核意见";
            }
            if (result[i].college_comment != null && result[i].college_comment!="null"){
                college_comment = result[i].college_comment;
            } else {
                college_comment = "未填写审核意见";
            }
            $("#audit-subject-list").append("<tr><td>" + result[i].id + "</td> <td>" + result[i].subject_title + "</td><td>" + result[i].major + "</td> <td>" + result[i].teacher_name + "(" + result[i].teacher_id + ")</td>" +
            " <td>通过</td> <td>" + comment + "</td> <td>" + audit + "</td><td>" + college_comment + "</td><td><button type=\"button\" class=\"btn \" data-toggle=\"modal\" data-target=\"#myModal\" onclick='writeModal(\"" + result[i].subject_title + "\",\"" + result[i].teacher_name + "\",\"" + result[i].teacher_id + "\",\"" + result[i].major + "\")'>" +
            "审核 </button></td> </tr>")
        }
    });
}

/**
 * 点击审核按钮之后改变模态框内容
 */
function writeModal(title, name, id,major) {
    $("#subject-title-modal").val(title);
    $("#subject-teacher-modal").val(name);
    $("#subject-major-modal").val(major);
    $("#subject-teacherid-modal").val(id);
}

function showTaskList() {
    $.get("/restful/college/task-list",function(result){
        for(var i=0;i<result.length;i++) {
            console.log(result[0]);
            $("#task-list").append("<tr><td>"+result[i].id+"</td> <td>"+result[i].student_name+"</td>" +
            " <td>"+result[i].student_major+"</td> <td>"+result[i].student_task_name+"</td><td><button type=\"button\" class=\"btn \" data-toggle=\"modal\" data-target=\"#myModal\" onclick='TaskEnsureModal(\"" + result[i].student_id + "\",\"" +  result[i].student_name + "\",\"" +  result[i].student_major + "\")'>" +
            "填写 </button></td></tr>");
        }

    });
}

function TaskEnsureModal(id,name,major){
    $("#student-id").val(id);
    $("#student-name").val(name);
    $("#major").val(major);
}



function initEnv(i) {
    $("#category").children().eq(i).addClass("active");
}

function showStartRList() {
    $.get("/restful/college/startr/list",function(result){
        for (var i = 0; i < result.length; i++) {
            var flag = 0;
            if (result[i].level == "null" ||result[i].level == null) {
                $("#startr-list").append("<tr><td>" + result[i].id + "</td> <td>" + result[i].title + "</td>" +
                " <td>" + result[i].student + "</td> <td><a href='"+result[i].addr+"'>下载</a></td> <td> 未判定成绩</td><td><button type=\"button\" class=\"btn \" data-toggle=\"modal\" data-target=\"#myModal\" onclick='StartRModal(\"" + result[i].id + "\",\"" + result[i].title + "\",\"" + result[i].student + "\")'>" +
                "审核 </button></td></tr>");
            }  else {
                $("#startr-list").append("<tr><td>" + result[i].id + "</td> <td>" + result[i].title + "</td>" +
                " <td>" + result[i].student + "</td><td><a href='"+result[i].addr+"'>下载</a></td><td> "+result[i].level +"</td><td><button type=\"button\" class=\"btn disabled\" data-toggle=\"modal\" data-target=\"#myModal\" onclick='StartRModal(\"" + result[i].id + "\",\"" + result[i].title + "\",\"" + result[i].student + "\")'>" +
                "审核 </button></td></tr>");
            }

        }
    });
}
function StartRModal(id,report,name){
    $("#startr-id-modal").val(id);
    $("#startr-title-modal").val(report);
    $("#startr-student-modal").val(name);
}

function showPaperList() {
    $.get("/restful/college/paper/list",function(result){
        for (var i = 0; i < result.length; i++) {
            var flag = 0;
            if (result[i].level == "null" ||result[i].level == null) {
                $("#startr-list").append("<tr><td>" + result[i].id + "</td> <td>" + result[i].title + "</td>" +
                " <td>" + result[i].student + "</td> <td><a href='"+result[i].addr+"'>下载</a></td> <td> 未判定成绩</td><td><button type=\"button\" class=\"btn \" data-toggle=\"modal\" data-target=\"#myModal\" onclick='StartRModal(\"" + result[i].id + "\",\"" + result[i].title + "\",\"" + result[i].student + "\")'>" +
                "审核 </button></td></tr>");
            }  else {
                $("#startr-list").append("<tr><td>" + result[i].id + "</td> <td>" + result[i].title + "</td>" +
                " <td>" + result[i].student + "</td><td><a href='"+result[i].addr+"'>下载</a></td><td> "+result[i].level +"</td><td><button type=\"button\" class=\"btn disabled\" data-toggle=\"modal\" data-target=\"#myModal\" onclick='StartRModal(\"" + result[i].id + "\",\"" + result[i].title + "\",\"" + result[i].student + "\")'>" +
                "审核 </button></td></tr>");
            }

        }
    });
}