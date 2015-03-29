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
            " <td>" + audit + "</td> <td>" + comment + "</td> <td><button type=\"button\" class=\"btn \" data-toggle=\"modal\" data-target=\"#myModal\" onclick='writeModal(\"" + result[i].subject_title + "\",\"" + result[i].teacher_name + "\",\"" + result[i].teacher_id + "\")'>" +
            "审核 </button></td> </tr>")
        }
    });
}

/**
 * 点击审核按钮之后改变模态框内容
 */
function writeModal(title, name, id) {
    $("#subject-title-modal").val(title);
    $("#subject-teacher-modal").val(name);
    $("#subject-teacherid-modal").val(id);
}

$(document).ready(function () {
    auditList();
});