<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<%@ page import = "java.lang.Math.*"%>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Hearthstone Deck Utility</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Richard Li, Steven Wang">
</head>
<body>
    The current deck is: 
<% String param = request.getParameter("deckname");%>
<%if(param != null && !param.isEmpty()){
    out.print(param);
  } %>
    
</body>
</html>