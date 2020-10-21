# JSON Output

For more complex designs, you may wish to build a custom javascript rendered
front-end based on the CMS configuration.

To help accomodate this, we have provided the ability to output all the block
data as JSON.

## Usage

The following provides an example of how you can output the JSON for use in
your `ElementDecisionTree.ss` SilverStripe template:

```
<div data-props="$BlockJSON"></div>
```

## Data structure

The JSON structure has been kept as flat as possible for simplicity. The
following is an example of the JSON:

```
{
  "blockTitle": "Decision Tree Block",
  "blockIntro": "<p>This is the intro content</p>",
  "steps": {
    1: {
      "title": "First question",
      "isQuestion": true,
      "content": "<p>This is the first question</p>",
      "hideTitle": false,
      "answers": [1, 2],
      "isFirst": true
    },
    2: {
      ...
    },
    3: {
      ...
    },
    ...
  },
  "answers": {
    1: {
      "title": "Yes",
      "goTo": 2
    },
    2: {
      "title": "No",
      "goTo": 3
    }
  }
}
```

## Extending

You may wish to add data to the JSON output for custom fields added or extra
design elements. This can easily be achieved by making use of the
`updateTreeData` hook on the `ElementDecisionTree` to add data to the root
level or the `updateJSONData` hooks for the `DecisionTreeStep` and
`DecisionTreeAnswer` to add data to the steps and answers respectively.
