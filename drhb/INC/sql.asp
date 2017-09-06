
<%
set rson=server.CreateObject("adodb.recordset")
sqlon="select * from ws_config"
rson.open sqlon,conn,1,1
if rson.eof and rson.bof then
	response.Write("请登录后台配置网站！")
	response.End()
else
	if rson("webon") then
		response.Write(rson("off_sm"))
		response.End()
	end if
end if

set rsip=server.CreateObject("adodb.recordset")
sqlip="select * from ws_sqlin where ip='"&Request.ServerVariables("REMOTE_ADDR")&"'"
rsip.open sqlip,conn,1,1
if rsip.eof and rsip.bof then
else
	do while not(rsip.eof or err)
		if rsip("killip") then
			response.write "<script>alert('您的IP已被拉黑锁定，请联系管理员！');window.opener=null; window.close();</script>"
			response.End()
		end if
	rsip.movenext
	loop	
end if
rsip.close:set rsip=nothing
Dim GetFlag Rem(提交方式)
Dim ErrorSql Rem(非法字符) 
Dim RequestKey Rem(提交数据)
Dim ForI Rem(循环标记)
set rszr=server.CreateObject("adodb.recordset")
sqlzr="select * from ws_sqlconfig"
rszr.open sqlzr,conn,1,1
if rszr.bof and rszr.eof then
	response.Write("请登录后台配置防SQL注入！")
	response.End()
else
	if rszr("anquanis") then
		url=Request.ServerVariables("URL")&"?"&Request.QueryString()
		if instr(LCase(rszr("anquan")),LCase(url))>0 then
		else
			ErrorSql=rszr("keywords")	
			ErrorSql = split(ErrorSql,"|")
			If Request.ServerVariables("REQUEST_METHOD")="GET" Then
			GetFlag=True
			Else
			GetFlag=False
			End If
			If GetFlag Then
			  For Each RequestKey In Request.QueryString
			   For ForI=0 To Ubound(ErrorSql)
				If Instr(LCase(Request.QueryString(RequestKey)),ErrorSql(ForI))<>0 Then
					if rszr("writesql") then
						set rsin=server.CreateObject("adodb.recordset")
						sqlin="select * from ws_sqlin"
						rsin.open sqlin,conn,1,3
						rsin.addnew
						rsin("ip")=Request.ServerVariables("REMOTE_ADDR")
						rsin("web")=Request.ServerVariables("URL")
						rsin("fs")=Request.ServerVariables("REQUEST_METHOD")
						rsin("intime")=now()
						rsin("cs")=N_Replace(RequestKey)
						rsin("sj")=N_Replace(Request.QueryString(RequestKey))
							if rszr("killip") then
								rsin("killip")=1
							end if
						rsin.update
						rsin.close:Set rsin=nothing
					end if
					
					if rszr("killip") then
										
						response.write "<script>alert('"&rszr("killinfo")&"');window.opener=null; window.close();</script>"
						response.End()
					else
						Select Case rszr("alerttype")
							Case 1
								response.write "<script>window.opener=null; window.close();</script>"
								response.End()
							Case 2
								response.write "<script>alert('"&rszr("alertinfo")&"');window.opener=null; window.close();</script>"		
								Response.End
							Case 3
								response.write "<script>window.location.href='"&rszr("alerturl")&"';</script>"
								response.End()
							Case 4
								response.write "<script>alert('"&rszr("alertinfo")&"');window.location.href='"&rszr("alerturl")&"'</script>"		
								Response.End
							Case Else 
								response.write "<script>window.opener=null; window.close();</script>"
								response.End()
						end Select
					end if		
				End If
			   Next
			  Next 
			Else
			  For Each RequestKey In Request.Form
			   For ForI=0 To Ubound(ErrorSql)
				If Instr(LCase(Request.Form(RequestKey)),ErrorSql(ForI))<>0 Then
					if rszr("writesql") then
						set rsin=server.CreateObject("adodb.recordset")
						sqlin="select * from ws_sqlin"
						rsin.open sqlin,conn,1,3
						rsin.addnew
						rsin("ip")=Request.ServerVariables("REMOTE_ADDR")
						rsin("web")=Request.ServerVariables("URL")
						rsin("fs")=Request.ServerVariables("REQUEST_METHOD")
						rsin("intime")=now()
						rsin("cs")=N_Replace(RequestKey)
						rsin("sj")=N_Replace(Request.form(RequestKey))
							if rszr("killip") then
								rsin("killip")=1
							end if
						rsin.update
						rsin.close:Set rsin=nothing
					end if
					
					if rszr("killip") then
										
						response.write "<script>alert('"&rszr("killinfo")&"');window.opener=null; window.close();</script>"
						response.End()
					else
						Select Case rszr("alerttype")
							Case 1
								response.write "<script>window.opener=null; window.close();</script>"
								response.End()
							Case 2
								response.write "<script>alert('"&rszr("alertinfo")&"');window.opener=null; window.close();</script>"		
								Response.End
							Case 3
								response.write "<script>window.location.href='"&rszr("alerturl")&"';</script>"
								response.End()
							Case 4
								response.write "<script>alert('"&rszr("alertinfo")&"');window.location.href='"&rszr("alerturl")&"'</script>"		
								Response.End
							Case Else 
								response.write "<script>window.opener=null; window.close();</script>"
								response.End()
						end Select
					end if		
				End If
			   Next
			  Next
			End If

		end if
	end if
end if
rszr.close:set rszr=nothing

'干掉xss脚本
Function N_Replace(N_urlString)
	N_urlString = Replace(N_urlString,"'","''")
    N_urlString = Replace(N_urlString, ">", "&gt;")
    N_urlString = Replace(N_urlString, "<", "&lt;")
    N_Replace = N_urlString
End Function
%>

