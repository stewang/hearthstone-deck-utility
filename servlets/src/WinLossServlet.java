import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

@WebServlet("/WinLossServlet")
public class WinLossServlet extends HttpServlet {
	private static final long serialVersionUID = 1L;

	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		HttpSession s = request.getSession(false);
		if (s != null) {
			int wins = ((Integer)s.getAttribute("wins")).intValue();
			int losses = ((Integer)s.getAttribute("losses")).intValue();
			String action = request.getParameter("action");
			if (action != null && action.equals("win"))
				s.setAttribute("wins", new Integer(++wins));
			else if (action != null && action.equals("loss"))
				s.setAttribute("losses", new Integer(++losses));
			response.setContentType("text/html");
			PrintWriter out = response.getWriter();
			out.println("<html>");
		    out.println("<head>");
		    out.println("  <title>Hearthstone Deck Utility</title>");
		    out.println("</head>");
		    out.println("<body>");
		    out.println("  <div>");
		    out.println("    Wins: " + wins + "\tLosses: " + losses);
		    out.println("  </div>");
		    out.println("  <a href=\"http://localhost/cs4640/hearthstone-deck-utility/tracker.php\">Back</a>");
		    out.println("</body>");
		    out.println("</html>"); 
		}
	}

	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		doGet(request, response);
	}
}
