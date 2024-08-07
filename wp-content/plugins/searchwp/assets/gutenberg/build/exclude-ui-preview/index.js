(()=>{"use strict";const e=window.wp.element,t=window.wp.editPost,s=window.wp.components,n=window.wp.i18n,l=window.wp.plugins;class a extends e.Component{render(){const l=wp.data.select("core/editor").getPostTypeLabel();return(0,e.createElement)(t.PluginPostStatusInfo,null,(0,e.createElement)("div",{className:"searchwp-exclude-preview",style:{position:"relative",padding:"10px","border-radius":"2px",backgroundColor:"#f0f0f0",color:"#7f7f7f"}},(0,e.createElement)("span",{style:{display:"block",position:"absolute",top:"0",right:"0"},onClick:this.dismissPreview},(0,e.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",width:"24",height:"24","aria-hidden":"true",focusable:"false"},(0,e.createElement)("path",{d:"M12 13.06l3.712 3.713 1.061-1.06L13.061 12l3.712-3.712-1.06-1.06L12 10.938 8.288 7.227l-1.061 1.06L10.939 12l-3.712 3.712 1.06 1.061L12 13.061z"}))),(0,e.createElement)(s.CheckboxControl,{label:(0,n.__)("Exclude from SearchWP"),checked:!1,disabled:!0,onChange:()=>{},style:{border:"1px solid rgba(0,0,0,.5)"}}),(0,e.createElement)("span",{style:{display:"block","margin-top":"10px"}},(0,e.createElement)("span",null,(0,n.sprintf)((0,n.__)("Activate the SearchWP Exclude UI extension and exclude any %s from your search results."),l)," "),(0,e.createElement)("br",null),(0,e.createElement)(s.ExternalLink,{href:"https://searchwp.com/extensions/exclude-ui/"},(0,n.__)("View Docs")),(0,e.createElement)(s.ExternalLink,{href:"/wp-admin/admin.php?page=searchwp-extensions",style:{display:"inline-block","margin-left":"10px"}},(0,n.__)("Activate")))))}dismissPreview(e){e.preventDefault(),jQuery.ajax({url:ajaxurl,type:"POST",data:{action:"searchwp_exclude_ui_preview_dismissed"},success:function(t){t.success&&(e.target.closest(".components-panel__row").style.display="none")}})}}(0,l.registerPlugin)("searchwp-exclude-ui-preview",{render:a})})();