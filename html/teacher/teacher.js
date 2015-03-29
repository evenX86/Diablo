/**
 * Created by xuyifei01 on 2015/3/29.
 */

function subjectList() {
    $.get("/restful/subject-list",function(result){
        var prof ="暂未通过",college = "暂未通过",update_time;
        for(var i=0;i<result.length;i++){
            if (result[i].prof_audit == "true"){
                prof = "通过";
            }
            if(result[i].college_audit == "true") {
                college = "通过";
            }
            if (result[i].update_time != "null") {
                update_time = "暂未更新";
            }
            $("#subject-list").append("<tr><td>"+result[i].id+"</td> <td>"+result[i].subject_title+"</td>" +
            " <td>"+prof+"</td> <td>"+college+"</td> <td> "+result[i].create_time+"</td><td> "+update_time+"</td> </tr>");
            prof ="暂未通过",college = "暂未通过";
        }
    });
}
$(document).ready(function () {
    subjectList();
});
