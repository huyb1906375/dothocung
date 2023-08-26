<%@ Page Language="C#" AutoEventWireup="true" CodeFile="Default.aspx.cs" Inherits="Fancy_Default" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Untitled Page</title>
    <!-- Add jQuery library -->
	<script type="text/javascript" src="css/fancybox2/lib/jquery-1.9.0.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="css/fancybox2/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="css/fancybox2/source/jquery.fancybox.js?v=2.1.4"></script>
	<link rel="stylesheet" type="text/css" href="css/fancybox2/source/jquery.fancybox.css?v=2.1.4" media="screen" />
    <script type="text/javascript">
        $(document).ready(function () {
            /*
            *  Simple image gallery. Uses default settings
            */

            $('.fancybox').fancybox();

            // different effect

            $(".fancybox").fancybox({
                afterClose: function () {
                    __doPostBack('<%= btnHiddenRefresh.UniqueID %>', '');
                    return;
                }
            });

        });
	</script>
</head>
<body>
    <form id="form1" runat="server">
    <asp:ScriptManager ID="ScriptManager1" runat="server">
        </asp:ScriptManager>
    
    <h3 class="ico_mug">
        
        Huyện</h3>
<fieldset>
    <fieldset> 
        <div class="clear"></div>  
        <div class="left button">
            <asp:HyperLink ID="hlkAddNew" CssClass="fancybox fancybox.iframe" runat="server" NavigateUrl="~/Fancy/Test.aspx">      
                Thêm mới&nbsp;
            </asp:HyperLink>
        </div>
        <div class="clear"></div>
    </fieldset>
    <asp:UpdatePanel runat="server" ID="updatePanel1">
    <ContentTemplate>
    <asp:Label ID="lblText" runat="server" Text="Label"></asp:Label>
    <asp:Button ID="btnHiddenRefresh" style='display:none' runat="server" 
            onclick="btnHiddenRefresh_Click"  />
    <fieldset>
    <legend>Tìm kiếm</legend>
        <table>            
            <tr>
                <td width="100px" align="left" >Huyện</td>
                <td width="500px" align="left" ><asp:TextBox AutoPostBack="true" runat="server" ID="txtSearchTen" CssClass="input" 
                        Width="400px" />  </td>       
            </tr>             
        </table>
    </fieldset>
    <fieldset>
    <legend>Danh sách Huyện</legend> 
    
    </fieldset>
</ContentTemplate>
</asp:UpdatePanel>
</fieldset>

    </form>
</body>
</html>
