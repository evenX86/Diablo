/**
 * Created by xuyifei01 on 2015/3/29.
 */
function auditList(){
    $.get("/restful/audit-list",function(result){
        console.log(result);
        for (var i=0;i<result.length;i++) {
            var audit = "未审核";
            if (result[i].prof_audit == "false"){
                audit = "审核未通过"
            } else if (result[i].prof_audit == "true"){
                audit = "本阶段已通过";
            }
            var commment;
            if (result[i].prof_comment != ""&&result[i].prof_comment!="null") {
                comment = "未填写审核意见";
            } else {
                comment =result[i].prof_comment;
            }

            $("#subject-content").append("<tr><td>"+result[i].id+"</td> <td>"+result[i].teacher_id+"</td>" +
            " <td>"+audit+"</td> <td>"+comment+"</td> <td><button type=\"button\" class=\"btn \" data-toggle=\"modal\" data-target=\"#myModal\" onclick='writeModal()'>" +
            "审核 </button></td> </tr>")
        }
    });
}

/**
 * 点击审核按钮之后改变模态框内容
 */
function writeModal(){
//$("#subject-audit-modal").html();

}

$(document).ready(function () {
    auditList();
});