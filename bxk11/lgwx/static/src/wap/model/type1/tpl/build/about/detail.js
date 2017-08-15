/*TMODJS:{"version":40,"md5":"cd4c15afc38117a08bef94ad63200f0d"}*/
define(function(require) {
    return require("../template")("about/detail", function($data, $id) {
        var $helpers = this, data = $data.data, $escape = $helpers.$escape, $out = "";
        $out += '<img src="/lgwx/static/system/wap/enterprise/';
        if (data.join_status == "0") {
            $out += "no";
        } else if (data.join_status == "1") {
            $out += "yes";
        }
        $out += '.png" width="20%" class="status"> <p><span class="mr_10">企业名称:</span>';
        $out += $escape(data.service_company);
        $out += '</p> <p><span class="mr_10">联系人名称:</span>';
        $out += $escape(data.service_person);
        $out += '</p> <p><span class="mr_10">联系人职务:</span>';
        $out += $escape(data.service_person_work);
        $out += '</p> <p><span class="mr_10">联系电话:</span>';
        $out += $escape(data.service_person_phone);
        $out += '</p> <p><span class="mr_10">企业邮箱:</span>';
        $out += $escape(data.service_email);
        $out += '</p> <p><span class="mr_10">企业描述:</span>';
        $out += $escape(data.service_desc);
        $out += "</p>";
        return new String($out);
    });
});