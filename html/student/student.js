/**
 * Created by xuyifei01 on 2015/3/30.
 */
function subjectList() {
    $.get("/student/subject/list",function(result){
        var name = result['name'];
        result = result['data'];
        for(var i=0;i<result.length;i++){
            $("#subject-enable").append("<tr><td>"+result[i].id+"</td> <td>"+result[i].subject_title+"</td>" +
            " <td>"+result[i].teacher_name+"</td> <td>"+result[i].major+"</td> <td> "+result[i].create_time+"</td><td><button type=\"button\" class=\"btn \" data-toggle=\"modal\" data-target=\"#myModal\" onclick='writeModal(\"" + result[i].subject_title + "\",\"" + result[i].teacher_name + "\",\"" + name + "\",\"" +  result[i].id + "\")'>" +
            "申请 </button></td></tr>");
        }
    });
}
$(document).ready(function () {
    subjectList();
});
function writeModal(title, name, id,subjectID) {
    $("#subject-title-modal").val(title);
    $("#subject-teacher-modal").val(name);
    $("#subject-teacherid-modal").val(id);
    $("#subject-id-modal").val(subjectID);
}

