@api
Feature: Task01
  In order to test api/task01 endpoint
  I will send texts in the get "b" parameter which will contain the contents of the get "a" parameter or will not
  Scenario Outline: Send "b" and "a". And "b" will contain contents of "a"
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/api/task01?a=<a>&b=<b>"
    Then the response status code should be 200
    And the JSON node "bHasAText" should be true
  Examples:
    | b                                                                                          | a                                                                                                                                |
    | The best thing about a boolean is even if you are wrong, you are only off by a bit.        | best     |
    | Programming is like sex. One mistake and you hastrpos to support it for the rest of your life. |  ake |
    | It's not a bug – it's an undocumented feature.                                             | eatur    |
  Scenario Outline: Send "b" and "a". And "b" will not contain contents of "a"
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/api/task01?a=<a>&b=<b>"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "bHasAText" should be false
    Examples:
      | a                                                                                          | b                                                                                                                                |
      | The best thing about a boolean is even if you are wrong, you are only off by a bit.        | It's a curious thing about our industry: not only do we not learn from our mistakes, but we also don't learn from our successes. |
      | Programming is like sex. One mistake and you have to support it for the rest of your life. | The best rpg game is The Witcher 3                                                                                               |
      | IThe best performance improvement is the transition from the nonworking state to the working state. | Deleted code is debugged code.                                                                                                   |

    Scenario Outline: Send empty "b" or "a".
      When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/api/task01?a=<a>&b=<b>"
      Then the response status code should be 200
      And the JSON node "bHasAText" should be false
      Examples:
      | a | b |
      |   | b |
      | a |   |
      |   |   |
  Scenario: Send without "b".
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/api/task01?a=a"
    Then the response status code should be 200
    And the JSON node "bHasAText" should be false
  Scenario: Send without "a".
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/api/task01?b=b"
    Then the response status code should be 200
    And the JSON node "bHasAText" should be false
  Scenario: Send without "a" and "b".
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/api/task01"
    Then the response status code should be 200
    And the JSON node "bHasAText" should be false