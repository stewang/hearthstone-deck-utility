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
    <h2>Statistics Tracker - Charts</h2>
    <%
    	HttpSession s = request.getSession(false);
		if (s.getAttribute("wins") != null && s.getAttribute("losses") != null) {
	%>

	    <p><pre>
Wins:   <%
	    	int wins = ((Integer)s.getAttribute("wins")).intValue();
	    	for (int i = 0; i < wins; i++)
	    		out.print("X");
	    %>
	    </pre></p>
	    <p><pre>
Losses: <%
	    	int losses = ((Integer)s.getAttribute("losses")).intValue();
	    	for (int i = 0; i < losses; i++)
	    		out.print("X");
	    %>
	    </pre></p>
	    <p><pre><%
	    	int sum = wins + losses;
	    	int winRate = Math.round(100*(float)wins/(float)sum);
	    %>
Winrate: <%= winRate %>%	
	    </pre></p>
	    
	    <jsp:include page="decksummary.jsp">
	   		<jsp:param name="deckname" value="Deck1" ></jsp:param>
	 	</jsp:include>
	 	
	 	<br><br>
	    
	    <a href="http://localhost/cs4640/hearthstone-deck-utility/tracker.php">Back</a>
    
    <%
    	} else {
    		response.sendRedirect("http://localhost/cs4640/hearthstone-deck-utility/login.php");
    	}
	%>
	  	

</body>
</html>